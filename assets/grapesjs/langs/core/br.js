
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;
const traitInputAttr = {
  placeholder: 'ex.: Texto aqui'
};
var _default = exports.default = {
  assetManager: {
    addButton: 'Adicionar imagem',
    inputPlh: 'http://path/to/the/image.jpg',
    modalTitle: 'Selecionar imagem',
    uploadTitle: 'Arraste os arquivos para cá ou clique para fazer upload'
  },
  // Here just as a reference, GrapesJS core doesn't contain any block,
  // so this should be omitted from other local files
  blockManager: {
    labels: {
      // 'block-id': 'Block Label',
    },
    categories: {
      // 'category-id': 'Category Label',
    }
  },
  domComponents: {
    names: {
      '': 'Caixa',
      wrapper: 'Corpo',
      text: 'Texto',
      comment: 'Comentário',
      image: 'Imagem',
      video: 'Vídeo',
      label: 'Rótulo',
      link: 'Link',
      map: 'Mapa',
      tfoot: 'Rodapé da tabela',
      tbody: 'Corpo da tabela',
      thead: 'Cabeçalho da tabela',
      table: 'Tabela',
      row: 'Linha da tabela',
      cell: 'Célula da tabela'
    }
  },
  deviceManager: {
    device: 'Dispositivo',
    devices: {
      desktop: 'Computador',
      tablet: 'Tablet',
      mobileLandscape: 'Celular (paisagem)',
      mobilePortrait: 'Celular (retrato)'
    }
  },
  panels: {
    buttons: {
      titles: {
        preview: 'Pré-visualizar',
        fullscreen: 'Tela cheia',
        'sw-visibility': 'Mostrar componentes',
        'export-template': 'Ver código',
        'open-sm': 'Abrir gerenciador de estilos',
        'open-tm': 'Configurações',
        'open-layers': 'Abrir gerenciador de camadas',
        'open-blocks': 'Abrir blocos'
      }
    }
  },
  selectorManager: {
    label: 'Classes',
    selected: 'Selecionado',
    emptyState: '- Estado -',
    states: {
      hover: 'Ao passar o mouse',
      active: 'Ao clicar',
      'nth-of-type(2n)': 'Par/Ímpar'
    }
  },
  styleManager: {
    empty: 'Selecione um elemento antes de usar o gerenciador de estilos',
    layer: 'Camada',
    fileButton: 'Imagens',
    sectors: {
      general: 'Geral',
      layout: 'Layout',
      typography: 'Tipografia',
      decorations: 'Decorações',
      extra: 'Extra',
      flex: 'Flex',
      dimension: 'Dimensões'
    },
    // Default names for sub properties in Composite and Stack types.
    // Other labels are generated directly from their property names (eg. 'font-size' will be 'Font size').
    properties: {
      'text-shadow-h': 'X',
      'text-shadow-v': 'Y',
      'text-shadow-blur': 'Desfoque',
      'text-shadow-color': 'Cor',
      'box-shadow-h': 'X',
      'box-shadow-v': 'Y',
      'box-shadow-blur': 'Desfoque',
      'box-shadow-spread': 'Expansão',
      'box-shadow-color': 'Cor',
      'box-shadow-type': 'Tipo',
      'margin-top-sub': 'Superior',
      'margin-right-sub': 'Direita',
      'margin-bottom-sub': 'Inferior',
      'margin-left-sub': 'Esquerda',
      'padding-top-sub': 'Superior',
      'padding-right-sub': 'Direita',
      'padding-bottom-sub': 'Inferior',
      'padding-left-sub': 'Esquerda',
      'border-width-sub': 'Largura',
      'border-style-sub': 'Estilo',
      'border-color-sub': 'Cor',
      'border-top-left-radius-sub': 'Canto superior esquerdo',
      'border-top-right-radius-sub': 'Canto superior direito',
      'border-bottom-right-radius-sub': 'Canto inferior direito',
      'border-bottom-left-radius-sub': 'Canto inferior esquerdo',
      'transform-rotate-x': 'Rotação X',
      'transform-rotate-y': 'Rotação Y',
      'transform-rotate-z': 'Rotação Z',
      'transform-scale-x': 'Escala X',
      'transform-scale-y': 'Escala Y',
      'transform-scale-z': 'Escala Z',
      'transition-property-sub': 'Propriedade',
      'transition-duration-sub': 'Duração',
      'transition-timing-function-sub': 'Temporização',
      'background-image-sub': 'Imagem',
      'background-repeat-sub': 'Repetição',
      'background-position-sub': 'Posição',
      'background-attachment-sub': 'Fixação',
      'background-size-sub': 'Tamanho'
    }
    // Translate options in style properties
    // options: {
    //   float: { // Id of the property
    //     ...
    //     left: 'Left', // {option id}: {Option label}
    //   }
    // }
  },
  traitManager: {
    empty: 'Selecione um elemento antes de usar o gerenciador de atributos',
    label: 'Configurações do componente',
    categories: {
      // categoryId: 'Category label',
    },
    traits: {
      // The core library generates the name by their `name` property
      labels: {
        // id: 'Id',
        // alt: 'Alt',
        // title: 'Title',
        // href: 'Href',
      },
      // In a simple trait, like text input, these are used on input attributes
      attributes: {
        id: traitInputAttr,
        alt: traitInputAttr,
        title: traitInputAttr,
        href: {
          placeholder: 'ex.: https://google.com'
        }
      },
      // In a trait like select, these are used to translate option names
      options: {
        target: {
          false: 'Esta janela',
          _blank: 'Nova janela'
        }
      }
    }
  },
  storageManager: {
    recover: 'Deseja recuperar as alterações não salvas?'
  }
};
// Additional GrapesJS labels used by the editor.
exports.default.styleManager.properties = Object.assign(exports.default.styleManager.properties || {}, {
  "float": "Flutuação",
  "display": "Exibição",
  "position": "Posição",
  "top": "Superior",
  "right": "Direita",
  "left": "Esquerda",
  "bottom": "Inferior",
  "width": "Largura",
  "height": "Altura",
  "max-width": "Largura (max.)",
  "max-height": "Altura (max.)",
  "margin": "Margem",
  "margin-top": "Margem: superior",
  "margin-right": "Margem: direita",
  "margin-left": "Margem: esquerda",
  "margin-bottom": "Margem: inferior",
  "padding": "Preenchimento",
  "padding-top": "Preenchimento: superior",
  "padding-left": "Preenchimento: esquerda",
  "padding-right": "Preenchimento: direita",
  "padding-bottom": "Preenchimento: inferior",
  "font-family": "Fonte: família",
  "font-size": "Fonte: tamanho",
  "font-weight": "Fonte: peso",
  "letter-spacing": "Letras: espaçamento",
  "color": "Cor",
  "line-height": "Linha: altura",
  "text-align": "Texto: alinhamento",
  "text-shadow": "Texto: sombra",
  "border-top-left": "Borda: superior · esquerda",
  "border-top-right": "Borda: superior · direita",
  "border-bottom-left": "Borda: inferior · esquerda",
  "border-bottom-right": "Borda: inferior · direita",
  "border-radius-top-left": "Borda: raio · superior · esquerda",
  "border-radius-top-right": "Borda: raio · superior · direita",
  "border-radius-bottom-left": "Borda: raio · inferior · esquerda",
  "border-radius-bottom-right": "Borda: raio · inferior · direita",
  "border-radius": "Borda: raio",
  "border": "Borda",
  "border-width": "Borda: largura",
  "border-style": "Borda: estilo",
  "border-color": "Borda: cor",
  "box-shadow": "Caixa: sombra",
  "background": "Fundo",
  "background-image": "Fundo: imagem",
  "background-repeat": "Fundo: repetição",
  "background-position": "Fundo: posição",
  "background-attachment": "Fundo: fixação",
  "background-size": "Fundo: tamanho",
  "background-color": "Fundo: cor",
  "transition": "Transição",
  "transition-property": "Transição: propriedade",
  "transition-duration": "Transição: duração",
  "transition-timing-function": "Transição: tempo",
  "perspective": "Perspectiva",
  "transform": "Transformação",
  "flex-direction": "Flex: direção",
  "flex-wrap": "Flex: quebra",
  "justify-content": "Justificação: conteúdo",
  "align-items": "Alinhamento: itens",
  "align-content": "Alinhamento: conteúdo",
  "order": "Ordem",
  "flex-basis": "Flex: base",
  "flex-grow": "Flex: crescimento",
  "flex-shrink": "Flex: redução",
  "align-self": "Alinhamento: próprio"
});
exports.default.traitManager.traits.labels = Object.assign(exports.default.traitManager.traits.labels || {}, {
  "id": "ID",
  "alt": "Texto alternativo",
  "title": "Título",
  "href": "Link"
});
