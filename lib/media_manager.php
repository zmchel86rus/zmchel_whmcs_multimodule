<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

// NEED ADD TRANSLATES

use Illuminate\Database\Capsule\Manager as Capsule;

if (!function_exists('zm_pb_media_manager_error')) {
    function zm_pb_media_manager_error($message) {
        return ['status' => 'error', 'title' => ZM_PB_ADMINLANG->other->error, 'message' => $message];
    }
}

if (!function_exists('zm_pb_media_manager_image_extensions')) {
    function zm_pb_media_manager_image_extensions() {
        return ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    }
}

if (!function_exists('zm_pb_media_manager_allowed_extensions')) {
    function zm_pb_media_manager_allowed_extensions() {
        return array_merge(zm_pb_media_manager_image_extensions(), ['mp3', 'wav', 'ogg', 'mp4', 'webm', 'pdf']);
    }
}

if (!function_exists('zm_pb_media_manager_images_sizes')) {
    function zm_pb_media_manager_images_sizes() {
        return ['large' => 1024, 'medium' => 512, 'small' => 256, 'thumbnail' => 128];
    }
}



if (!function_exists('zm_pb_media_manager_size_data')) {
    function zm_pb_media_manager_size_data($fileName) {
        $path = rtrim(ZM_PB_MAINSYSTEM_ATTACHMENTS_DIR, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $fileName;
        $imageSize = @getimagesize($path);

        return [
            'filename' => $fileName,
            'url' => ZM_PB_MAINSYSTEM_ATTACHMENTS_URL . rawurlencode($fileName),
            'width' => $imageSize[0] ?? null,
            'height' => $imageSize[1] ?? null,
            'bytes' => file_exists($path) ? filesize($path) : null,
        ];
    }
}

if (!function_exists('zm_pb_media_manager_file_data')) {
    function zm_pb_media_manager_file_data($attachment) {
        $extension = strtolower(pathinfo($attachment->filename, PATHINFO_EXTENSION));
        $isImage = in_array($extension, zm_pb_media_manager_image_extensions(), true);
        $sizes = is_string($attachment->sizes) ? json_decode($attachment->sizes, true) : $attachment->sizes;
        $sized = [];
        $variants = [];
        if (is_array($sizes)) {
            foreach ($sizes as $sizeName => $sizeData) {
                if (is_array($sizeData) && !empty($sizeData['filename'])) {
                    $url = ZM_PB_MAINSYSTEM_ATTACHMENTS_URL . rawurlencode($sizeData['filename']);
                    $sized[$sizeName] = $url;
                    $variants[$sizeName] = [
                        'url' => $url,
                        'width' => (int) ($sizeData['width'] ?? 0),
                        'height' => (int) ($sizeData['height'] ?? 0),
                    ];
                }
            }
        }
        if ($isImage && (empty($variants['full']['width']) || empty($variants['full']['height']))) {
            $full = zm_pb_media_manager_size_data($attachment->filename);
            if (!empty($full['width']) && !empty($full['height'])) {
                $variants['full'] = [
                    'url' => $attachment->url ?: $full['url'],
                    'width' => (int) $full['width'],
                    'height' => (int) $full['height'],
                ];
                $sized['full'] = $variants['full']['url'];
            }
        }

        return [
            'id' => (int) $attachment->id,
            'name' => $attachment->name,
            'filename' => $attachment->filename,
            'alt' => $attachment->alt,
            'title' => $attachment->title,
            'description' => $attachment->description,
            'url' => $attachment->url,
            'is_image' => $isImage,
            'mime_type' => $attachment->mime_type,
            'sized' => $sized,
            'variants' => $variants,
            'width' => $variants['full']['width'] ?? null,
            'height' => $variants['full']['height'] ?? null,
            'optimization_attempted' => !empty($attachment->optimization_attempted),
            'created_at' => $attachment->created_at,
            'updated_at' => $attachment->updated_at,
        ];
    }
}

if (!function_exists('zm_pb_media_manager_list')) {
    function zm_pb_media_manager_list() {
        return Capsule::table('zm_pb_attachments')
            ->orderByDesc('id')
            ->limit(100)
            ->get()
            ->filter(function($attachment) {
                $path = rtrim(ZM_PB_MAINSYSTEM_ATTACHMENTS_DIR, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $attachment->filename;
                return file_exists($path);
            })
            ->map(function($attachment) {
                return zm_pb_media_manager_file_data($attachment);
            })
            ->values()
            ->all();
    }
}

if (!function_exists('zm_pb_media_manager_page')) {
    function zm_pb_media_manager_page(array $filters = []) {
        $type = is_string($filters['type'] ?? null) ? $filters['type'] : '';
        if (!in_array($type, ['', 'image', 'audio', 'video', 'pdf'], true)) $type = '';
        $search = is_string($filters['search'] ?? null) ? trim($filters['search']) : '';
        $search = function_exists('mb_substr') ? mb_substr($search, 0, 128, 'UTF-8') : substr($search, 0, 128);
        $beforeId = max(0, (int) (is_scalar($filters['before_id'] ?? null) ? $filters['before_id'] : 0));
        $limit = 24;
        $files = [];
        $hasMore = false;
        $scanId = $beforeId;

        do {
            $query = Capsule::table('zm_pb_attachments')->orderByDesc('id');
            if ($scanId > 0) $query->where('id', '<', $scanId);
            if ($search !== '') {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('title', 'like', '%' . $search . '%')
                        ->orWhere('filename', 'like', '%' . $search . '%');
                });
            }
            if ($type !== '') {
                $extensions = $type === 'image' ? zm_pb_media_manager_image_extensions()
                    : ($type === 'audio' ? ['mp3', 'wav', 'ogg']
                    : ($type === 'video' ? ['mp4', 'webm'] : ['pdf']));
                $query->where(function ($query) use ($extensions) {
                    foreach ($extensions as $index => $extension) {
                        if ($index === 0) $query->where('filename', 'like', '%.' . $extension);
                        else $query->orWhere('filename', 'like', '%.' . $extension);
                    }
                });
            }
            $batch = $query->limit(48)->get();
            foreach ($batch as $attachment) {
                $scanId = (int) $attachment->id;
                $path = rtrim(ZM_PB_MAINSYSTEM_ATTACHMENTS_DIR, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $attachment->filename;
                if (!is_file($path)) continue;
                if (count($files) === $limit) {
                    $hasMore = true;
                    break;
                }
                $files[] = zm_pb_media_manager_file_data($attachment);
            }
            if ($hasMore || $batch->count() < 48) break;
        } while ($scanId > 0);

        return [
            'files' => $files,
            'has_more' => $hasMore,
            'next_cursor' => $hasMore && $files ? $files[count($files) - 1]['id'] : null,
        ];
    }
}
if (!function_exists('zm_pb_media_manager_action')) {
    function zm_pb_media_manager_action($data, $action)
    {
        $updatableFields = ['name', 'alt', 'title', 'description'];
        $media_id = $data['id'] ?? null;

        switch ($action) {
            case 'media_manager_image_optimize':
                try {
                    return zm_pb_media_manager_optimize_attachment((int) $media_id);
                } catch (Throwable $error) {
                    error_log('zmchel WHMCS Multimodule image optimization: ' . $error->getMessage());
                    return zm_pb_media_manager_error(ZM_PB_ADMINLANG->media_manager->optimization_failed);
                }
            case 'media_manager_image_save':
                if (empty($media_id)) return ['status'=>'error','title'=> ZM_PB_ADMINLANG->other->error ,'message' => ZM_PB_ADMINLANG->media_manager->missing_id ];
                
                $update = [];
                foreach ($updatableFields as $field) {
                    if (array_key_exists($field, $data)) $update[$field] = $data[$field];
                }

                if (empty($update)) return ['status'=>'error','title'=> ZM_PB_ADMINLANG->other->error ,'message' => ZM_PB_ADMINLANG->other->nothing_update ];
                
                $update['updated_at'] = date('Y-m-d H:i:s');
                $affected = Capsule::table('zm_pb_attachments')
                    ->where('id', (int) $media_id)
                    ->update($update);

                if (!$affected) return ['status'=>'error','title'=> ZM_PB_ADMINLANG->other->error ,'message' => '' ];

                $attachment = Capsule::table('zm_pb_attachments')
                    ->where('id', (int) $media_id)
                    ->first();

                return ['status'=>'success','title'=> ZM_PB_ADMINLANG->other->success ,'message' => '' ];

            case 'delete':
                if (empty($media_id)) return ['status'=>'error','title'=> ZM_PB_ADMINLANG->other->error ,'message' => ZM_PB_ADMINLANG->media_manager->missing_id ];
                

                $attachment = Capsule::table('zm_pb_attachments')
                    ->where('id', (int) $media_id)
                    ->first();

                if (!$attachment) return ['status'=>'error','title'=> ZM_PB_ADMINLANG->other->error ,'message' => ZM_PB_ADMINLANG->other->no_found ];
                

                $baseDir = rtrim(ZM_PB_MAINSYSTEM_ATTACHMENTS_DIR, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;

                if (!empty($attachment->filename)) {
                    $mainPath = $baseDir . $attachment->filename;
                    if (file_exists($mainPath)) @unlink($mainPath);
                }

                $isImage = $attachment->mime_type && strpos($attachment->mime_type, 'image/') === 0;

                if ($isImage && !empty($attachment->sizes)) {
                    $sizes = is_string($attachment->sizes) ? json_decode($attachment->sizes, true) : (array) $attachment->sizes;

                    if (is_array($sizes)) {
                        foreach ($sizes as $sizeData) {
                           
                            $file = null;
                            if (is_string($sizeData)) $file = $sizeData;
                            elseif (is_array($sizeData)) $file = $sizeData['filename'] ?? $sizeData['file'] ?? $sizeData['path'] ?? null;
                            elseif (is_object($sizeData)) $file = $sizeData->filename ?? $sizeData->file ?? $sizeData->path ?? null;
                            
                            if (!$file) continue;

                            $file = basename(parse_url($file, PHP_URL_PATH) ?: $file);
                            $path = $baseDir . $file;

                            if (file_exists($path)) @unlink($path);
                        }
                    }
                }

                Capsule::table('zm_pb_attachments')
                    ->where('id', (int) $media_id)
                    ->delete();

                return ['status'=>'success','title'=> ZM_PB_ADMINLANG->other->success ,'message' => '' ];
            default:
                return ['status'=>'error','title'=> ZM_PB_ADMINLANG->other->error ,'message' => ZM_PB_ADMINLANG->other->unknown_action ];
        }
    }
}


if (!function_exists('zm_pb_media_manager_open_image')) {
    function zm_pb_media_manager_open_image($path, $extension, &$oriented = false) {
        $oriented = false;
        // GD expands compressed files in memory; keep very large uploads intact.
        $size = @getimagesize($path);
        if (!$size || $size[0] < 1 || $size[1] < 1 || $size[0] * $size[1] > 16000000) return false;
        if ($extension === 'gif') return false; // GD would drop animation frames.
        if ($extension === 'webp') {
            $handle = @fopen($path, 'rb');
            $header = $handle ? fread($handle, 32) : '';
            if ($handle) fclose($handle);
            if (substr($header, 12, 4) === 'VP8X' && isset($header[20]) && (ord($header[20]) & 2)) return false;
        }
        $create = ['jpg' => 'imagecreatefromjpeg', 'jpeg' => 'imagecreatefromjpeg',
            'png' => 'imagecreatefrompng', 'webp' => 'imagecreatefromwebp'];
        if (!isset($create[$extension]) || !function_exists($create[$extension])) return false;
        $loader = $create[$extension];
        $image = @$loader($path);
        if (!$image) return false;
        if (in_array($extension, ['jpg', 'jpeg'], true) && function_exists('exif_read_data')) {
            $exif = @exif_read_data($path);
            $orientation = (int) ($exif['Orientation'] ?? 1);
            $angle = in_array($orientation, [5, 6], true) ? 270
                : (in_array($orientation, [3, 4], true) ? 180
                : (in_array($orientation, [7, 8], true) ? 90 : 0));
            if ($angle) {
                $rotated = @imagerotate($image, $angle, 0);
                if (!$rotated) { imagedestroy($image); return false; }
                imagedestroy($image);
                $image = $rotated;
            }
            if (in_array($orientation, [2, 4, 5, 7], true)) imageflip($image, IMG_FLIP_HORIZONTAL);
            $oriented = $orientation >= 2 && $orientation <= 8;
        }
        return $image;
    }
}

if (!function_exists('zm_pb_media_manager_save_image')) {
    function zm_pb_media_manager_save_image($image, $path, $extension, $quality = 82) {
        if (in_array($extension, ['jpg', 'jpeg'], true)) {
            imageinterlace($image, true);
            return @imagejpeg($image, $path, $quality);
        }
        if ($extension === 'png') return @imagepng($image, $path, 9);
        if ($extension === 'webp') return @imagewebp($image, $path, $quality);
        return false;
    }
}

if (!function_exists('zm_pb_media_manager_optimize_image')) {
    function zm_pb_media_manager_optimize_image($path, $extension) {
        $oriented = false;
        $image = zm_pb_media_manager_open_image($path, $extension, $oriented);
        if (!$image) return false;
        $temporary = @tempnam(dirname($path), '.zm-pb-image-');
        if (!$temporary) { imagedestroy($image); return false; }
        $saved = zm_pb_media_manager_save_image($image, $temporary, $extension);
        imagedestroy($image);
        $originalBytes = @filesize($path);
        $optimizedBytes = $saved ? @filesize($temporary) : false;
        if (!$optimizedBytes || (!$oriented && $originalBytes && $optimizedBytes >= $originalBytes)) {
            @unlink($temporary);
            return false;
        }
        if (!@rename($temporary, $path)) {
            $saved = @copy($temporary, $path);
            @unlink($temporary);
            if ($saved) clearstatcache(true, $path);
            return $saved;
        }
        clearstatcache(true, $path);
        return true;
    }
}

if (!function_exists('zm_pb_media_manager_optimize_attachment')) {
    function zm_pb_media_manager_optimize_attachment($id) {
        $text = ZM_PB_ADMINLANG->media_manager;
        $error = function ($message) { return zm_pb_media_manager_error($message); };
        if ($id < 1) return $error($text->optimization_failed);
        if (!Capsule::schema()->hasColumn('zm_pb_attachments', 'optimization_attempted')) {
            return $error($text->optimization_needs_db_fix);
        }
        $attachment = Capsule::table('zm_pb_attachments')->where('id', $id)->first();
        if (!$attachment) return $error(ZM_PB_ADMINLANG->other->no_found);
        $extension = strtolower(pathinfo((string) $attachment->filename, PATHINFO_EXTENSION));
        if (!in_array($extension, ['jpg', 'jpeg', 'png', 'webp'], true)) return $error($text->optimization_unsupported);
        $filename = (string) $attachment->filename;
        if ($filename !== basename($filename) || !preg_match('/^[a-zA-Z0-9_.-]+$/D', $filename)) {
            return $error($text->optimization_failed);
        }
        $directory = rtrim(ZM_PB_MAINSYSTEM_ATTACHMENTS_DIR, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
        $fullPath = $directory . $filename;
        if (!is_file($fullPath) || !is_writable($fullPath)) return $error($text->optimization_failed);
        $check = zm_pb_media_manager_open_image($fullPath, $extension);
        if (!$check) return $error($text->optimization_unsupported);
        imagedestroy($check);

        $sizes = is_string($attachment->sizes) ? json_decode($attachment->sizes, true) : (array) $attachment->sizes;
        if (!is_array($sizes)) $sizes = [];
        $before = (int) filesize($fullPath);
        foreach ($sizes as $name => $size) {
            if ($name === 'full' || !is_array($size) || empty($size['filename'])) continue;
            $variant = (string) $size['filename'];
            if ($variant !== basename($variant) || !preg_match('/^[a-zA-Z0-9_.-]+$/D', $variant)) continue;
            if (is_file($directory . $variant)) $before += (int) filesize($directory . $variant);
        }
        $wasOptimized = !empty($attachment->optimization_attempted);
        if (!$wasOptimized || $extension === 'png') zm_pb_media_manager_optimize_image($fullPath, $extension);
        $updated = ['full' => zm_pb_media_manager_size_data($filename)];
        $after = (int) filesize($fullPath);
        $standardSizes = zm_pb_media_manager_images_sizes();
        foreach ($sizes as $name => $size) {
            if ($name === 'full' || isset($standardSizes[$name]) || !is_array($size) || empty($size['filename'])) continue;
            $variant = (string) $size['filename'];
            if ($variant !== basename($variant) || !preg_match('/^[a-zA-Z0-9_.-]+$/D', $variant)
                || strtolower(pathinfo($variant, PATHINFO_EXTENSION)) !== $extension) continue;
            $variantPath = $directory . $variant;
            if (!is_file($variantPath)) continue;
            if (!$wasOptimized || $extension === 'png') zm_pb_media_manager_optimize_image($variantPath, $extension);
            clearstatcache(true, $variantPath);
            if (filesize($variantPath) < filesize($fullPath)) {
                $updated[$name] = zm_pb_media_manager_size_data($variant);
                $after += (int) filesize($variantPath);
            }
        }
        $base = pathinfo($filename, PATHINFO_FILENAME);
        foreach ($standardSizes as $name => $maxSide) {
            $known = isset($sizes[$name]['filename']);
            $variant = $known ? (string) $sizes[$name]['filename'] : $base . '_' . $name . '.' . $extension;
            if ($variant !== basename($variant) || !preg_match('/^[a-zA-Z0-9_.-]+$/D', $variant)
                || strtolower(pathinfo($variant, PATHINFO_EXTENSION)) !== $extension) continue;
            $variantPath = $directory . $variant;
            if (!$known && (is_file($variantPath)
                || Capsule::table('zm_pb_attachments')->where('filename', $variant)->exists())) continue;
            if (is_file($variantPath) && (!$wasOptimized || $extension === 'png')) {
                zm_pb_media_manager_optimize_image($variantPath, $extension);
            }
            zm_pb_media_manager_rebuild_variant($fullPath, $variantPath, $maxSide, $extension);
            clearstatcache(true, $variantPath);
            if (is_file($variantPath) && filesize($variantPath) < filesize($fullPath)) {
                $updated[$name] = zm_pb_media_manager_size_data($variant);
                $after += (int) filesize($variantPath);
            } elseif (is_file($variantPath) && !$known) {
                @unlink($variantPath);
            }
        }
        Capsule::table('zm_pb_attachments')->where('id', $id)->update([
            'sizes' => json_encode($updated), 'optimization_attempted' => true,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        $attachment = Capsule::table('zm_pb_attachments')->where('id', $id)->first();
        return [
            'status' => 'success', 'title' => ZM_PB_ADMINLANG->other->success,
            'message' => $text->optimization_done,
            'file' => zm_pb_media_manager_file_data($attachment),
            'bytes_before' => $before, 'bytes_after' => $after,
        ];
    }
}

if (!function_exists('zm_pb_media_manager_resize_image')) {
    function zm_pb_media_manager_resize_image($sourcePath, $targetPath, $maxSide, $extension, $allowLargerThanSource = false) {
        $source = zm_pb_media_manager_open_image($sourcePath, $extension);
        if (!$source) return false;
        $sourceWidth = imagesx($source);
        $sourceHeight = imagesy($source);
        $palettePng = $extension === 'png' && !imageistruecolor($source) && imagecolortransparent($source) < 0;
        if ($palettePng) {
            for ($index = 0, $colors = imagecolorstotal($source); $index < $colors; $index++) {
                if (imagecolorsforindex($source, $index)['alpha'] > 0) { $palettePng = false; break; }
            }
        }
        if (max($sourceWidth, $sourceHeight) <= $maxSide) { imagedestroy($source); return false; }
        $ratio = min($maxSide / $sourceWidth, $maxSide / $sourceHeight);
        $width = max(1, (int) round($sourceWidth * $ratio));
        $height = max(1, (int) round($sourceHeight * $ratio));
        $target = imagecreatetruecolor($width, $height);

        if (in_array($extension, ['png', 'webp'], true)) {
            imagealphablending($target, false);
            imagesavealpha($target, true);
            imagefill($target, 0, 0, imagecolorallocatealpha($target, 0, 0, 0, 127));
        }

        imagecopyresampled($target, $source, 0, 0, 0, 0, $width, $height, $sourceWidth, $sourceHeight);
        if ($palettePng) imagetruecolortopalette($target, true, 256);
        $saved = zm_pb_media_manager_save_image($target, $targetPath, $extension, $maxSide >= 512 ? 78 : 82);
        imagedestroy($source);
        imagedestroy($target);
        if (!$saved || !is_file($targetPath) || (!$allowLargerThanSource && filesize($targetPath) >= filesize($sourcePath))) {
            if (is_file($targetPath)) @unlink($targetPath);
            return false;
        }
        return true;
    }
}

if (!function_exists('zm_pb_media_manager_rebuild_variant')) {
    function zm_pb_media_manager_rebuild_variant($sourcePath, $targetPath, $maxSide, $extension) {
        $temporary = @tempnam(dirname($targetPath), '.zm-pb-variant-');
        if (!$temporary) return false;
        if (!zm_pb_media_manager_resize_image($sourcePath, $temporary, $maxSide, $extension, true)) {
            @unlink($temporary);
            return false;
        }
        clearstatcache(true, $temporary);
        clearstatcache(true, $targetPath);
        $candidateSize = @getimagesize($temporary);
        $existingSize = is_file($targetPath) ? @getimagesize($targetPath) : false;
        $replace = $candidateSize && (!$existingSize
            || $candidateSize[0] !== $existingSize[0] || $candidateSize[1] !== $existingSize[1]
            || filesize($temporary) < filesize($targetPath));
        if (!$replace) { @unlink($temporary); return false; }
        if (!@rename($temporary, $targetPath)) {
            $replaced = @copy($temporary, $targetPath);
            @unlink($temporary);
            if (!$replaced) return false;
        }
        clearstatcache(true, $targetPath);
        return true;
    }
}

if (!function_exists('zm_pb_media_manager_upload')) {
    function zm_pb_media_manager_upload($data,$method_action = 'media_manager_upload') {
        $file = $method_action === 'media_manager_upload' ? $data : $data['file'];

        if (!is_array($file) || ($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK || !is_uploaded_file($file['tmp_name'])) {
            return zm_pb_media_manager_error('#ERROR-MEDIA #1');
        }
        if (($file['size'] ?? 0) <= 0 || $file['size'] > 10 * 1024 * 1024) {
            return zm_pb_media_manager_error('#ERROR-MEDIA #2');
        }

        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($extension, zm_pb_media_manager_allowed_extensions(), true)) {
            return zm_pb_media_manager_error('#ERROR-MEDIA #3');
        }
        if (in_array($extension, zm_pb_media_manager_image_extensions(), true) && !@getimagesize($file['tmp_name'])) {
            return zm_pb_media_manager_error('#ERROR-MEDIA #4');
        }
        if (in_array($extension, ['jpg', 'jpeg', 'png', 'webp'], true)) {
            $createFunctions = [
                'jpg' => 'imagecreatefromjpeg',
                'jpeg' => 'imagecreatefromjpeg',
                'png' => 'imagecreatefrompng',
                'webp' => 'imagecreatefromwebp',
            ];
            $saveFunctions = [
                'jpg' => 'imagejpeg',
                'jpeg' => 'imagejpeg',
                'png' => 'imagepng',
                'webp' => 'imagewebp',
            ];
            if (!function_exists('imagecreatetruecolor') || !function_exists($createFunctions[$extension]) || !function_exists($saveFunctions[$extension])) {
                return zm_pb_media_manager_error('#ERROR-MEDIA #5');
            }
        }
        if (!is_dir(ZM_PB_MAINSYSTEM_ATTACHMENTS_DIR) && !mkdir(ZM_PB_MAINSYSTEM_ATTACHMENTS_DIR, 0755, true) && !is_dir(ZM_PB_MAINSYSTEM_ATTACHMENTS_DIR)) {
            return zm_pb_media_manager_error('#ERROR-MEDIA #6');
        }
        if (!is_writable(ZM_PB_MAINSYSTEM_ATTACHMENTS_DIR)) {
            return zm_pb_media_manager_error('#ERROR-MEDIA #7');
        }

        $originalName = basename(str_replace('\\', '/', $file['name']));

        $name = trim((string) ($data['name'] ?? ''));
        $alt = trim((string) ($data['alt'] ?? ''));
        $title = trim((string) ($data['title'] ?? ''));
        $description = trim((string) ($data['description'] ?? ''));

        $baseName = zm_pb_transtaliteration(pathinfo($originalName, PATHINFO_FILENAME));
        if ($baseName === '') $baseName = 'file';
        $baseName = substr($baseName, 0, 110);
        $fileName = $baseName . '.' . $extension;
        $fileNumber = 1;
        while (
            Capsule::table('zm_pb_attachments')->where('filename', $fileName)->exists()
            || file_exists(rtrim(ZM_PB_MAINSYSTEM_ATTACHMENTS_DIR, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $fileName)
        ) {
            $fileName = $baseName . '_' . $fileNumber . '.' . $extension;
            $fileNumber++;
        }

        $path = rtrim(ZM_PB_MAINSYSTEM_ATTACHMENTS_DIR, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $fileName;
        if (!move_uploaded_file($file['tmp_name'], $path)) {
            error_log('zmchel WHMCS Multimodule: unable to move uploaded media file to ' . ZM_PB_MAINSYSTEM_ATTACHMENTS_DIR);
            return zm_pb_media_manager_error('#ERROR-MEDIA #8');
        }

        $sizes = [];
        $savedFiles = [$fileName];
        $optimizationAttempted = false;
        if (in_array($extension, zm_pb_media_manager_image_extensions(), true)) {
            if (in_array($extension, ['jpg', 'jpeg', 'png', 'webp'], true)) {
                zm_pb_media_manager_optimize_image($path, $extension);
                $optimizationAttempted = true;
            }
            $baseName = pathinfo($fileName, PATHINFO_FILENAME);
            foreach ( zm_pb_media_manager_images_sizes() as $sizeName => $maxSide) {
                $variantName = $baseName . '_' . $sizeName . '.' . $extension;
                $variantPath = rtrim(ZM_PB_MAINSYSTEM_ATTACHMENTS_DIR, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $variantName;
                if (zm_pb_media_manager_resize_image($path, $variantPath, $maxSide, $extension)) {
                    $sizes[$sizeName] = zm_pb_media_manager_size_data($variantName);
                    $savedFiles[] = $variantName;
                }
            }
            $fullBytes = filesize($path);
            foreach ($sizes as $sizeName => $sizeData) {
                $variantPath = rtrim(ZM_PB_MAINSYSTEM_ATTACHMENTS_DIR, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $sizeData['filename'];
                if (is_file($variantPath) && filesize($variantPath) >= $fullBytes) {
                    @unlink($variantPath);
                    unset($sizes[$sizeName]);
                }
            }
            $sizes = ['full' => zm_pb_media_manager_size_data($fileName)] + $sizes;
        }

        try {
            $record = [
                'name' => $name !== '' ? $name : $originalName,
                'filename' => $fileName,
                'mime_type' => $file['type'] ?? null,
                'alt' => $alt,
                'title' => $title,
                'description' => $description,
                'url' => ZM_PB_MAINSYSTEM_ATTACHMENTS_URL . rawurlencode($fileName),
                'sizes' => json_encode($sizes),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            if (Capsule::schema()->hasColumn('zm_pb_attachments', 'optimization_attempted')) {
                $record['optimization_attempted'] = $optimizationAttempted;
            }
            $attachmentId = Capsule::table('zm_pb_attachments')->insertGetId($record);
        } catch (Exception $e) {
            foreach (array_unique($savedFiles) as $savedFile) {
                $savedPath = rtrim(ZM_PB_MAINSYSTEM_ATTACHMENTS_DIR, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $savedFile;
                if (file_exists($savedPath)) unlink($savedPath);
            }
            return zm_pb_media_manager_error('#ERROR-MEDIA #9');
        }

        $attachment = Capsule::table('zm_pb_attachments')->where('id', $attachmentId)->first();
        return ['status' => 'success', 'file' => zm_pb_media_manager_file_data($attachment)];
    }
}
