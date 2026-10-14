
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
    uploadTitle: 'Arraste os ficheiros para aqui ou clique para carregar'
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
      label: 'Etiqueta',
      link: 'Hiperligação',
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
      mobileLandscape: 'Telemóvel (horizontal)',
      mobilePortrait: 'Telemóvel (vertical)'
    }
  },
  panels: {
    buttons: {
      titles: {
        preview: 'Pré-visualizar',
        fullscreen: 'Ecrã inteiro',
        'sw-visibility': 'Mostrar componentes',
        'export-template': 'Ver código',
        'open-sm': 'Abrir gestor de estilos',
        'open-tm': 'Definições',
        'open-layers': 'Abrir gestor de camadas',
        'open-blocks': 'Abrir blocos'
      }
    }
  },
  selectorManager: {
    label: 'Classes',
    selected: 'Selecionado',
    emptyState: '- Estado -',
    states: {
      hover: 'Ao passar o rato',
      active: 'Ao clicar',
      'nth-of-type(2n)': 'Par/Ímpar'
    }
  },
  styleManager: {
    empty: 'Selecione um elemento antes de utilizar o gestor de estilos',
    layer: 'Camada',
    fileButton: 'Imagens',
    sectors: {
      general: 'Geral',
      layout: 'Disposição',
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
      'text-shadow-blur': 'Desfocagem',
      'text-shadow-color': 'Cor',
      'box-shadow-h': 'X',
      'box-shadow-v': 'Y',
      'box-shadow-blur': 'Desfocagem',
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
    empty: 'Selecione um elemento antes de utilizar o gestor de atributos',
    label: 'Definições do componente',
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
    recover: 'Pretende recuperar as alterações não guardadas?'
  }
};

// Additional GrapesJS labels used by the editor.
exports.default.styleManager.properties = Object.assign(exports.default.styleManager.properties || {}, {
  "float": "Flutuação",
  "display": "Apresentação",
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
  "font-family": "Tipo de letra: família",
  "font-size": "Tipo de letra: tamanho",
  "font-weight": "Tipo de letra: espessura",
  "letter-spacing": "Letras: espaçamento",
  "color": "Cor",
  "line-height": "Linha: altura",
  "text-align": "Texto: alinhamento",
  "text-shadow": "Texto: sombra",
  "border-top-left": "Contorno: superior · esquerda",
  "border-top-right": "Contorno: superior · direita",
  "border-bottom-left": "Contorno: inferior · esquerda",
  "border-bottom-right": "Contorno: inferior · direita",
  "border-radius-top-left": "Contorno: raio · superior · esquerda",
  "border-radius-top-right": "Contorno: raio · superior · direita",
  "border-radius-bottom-left": "Contorno: raio · inferior · esquerda",
  "border-radius-bottom-right": "Contorno: raio · inferior · direita",
  "border-radius": "Contorno: raio",
  "border": "Contorno",
  "border-width": "Contorno: largura",
  "border-style": "Contorno: estilo",
  "border-color": "Contorno: cor",
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
  "perspective": "Perspetiva",
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
  "href": "Ligação"
});
