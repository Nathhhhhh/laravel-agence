module.exports = {
  build: {
    posthtml: {
      expressions: {
        unescapeDelimiters: ['{!!', '!!}']
      }
    },
    templates: {
      destination: {
        path: '../resources/views/emails',
        extension: 'blade.php',
      },
      assets: {
        destination: '../../../public/images/emails',
      },
    },
  },
  inlineCSS: true,
  removeUnusedCSS: true,
  shorthandCSS: true,
  prettify: true,
}
