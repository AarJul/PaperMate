// const { defineConfig } = require('@vue/cli-service')
// module.exports = defineConfig({
//   transpileDependencies: true
// })
module.exports = {
  configureWebpack: {
    output: {
      library: 'Navbar',
      libraryTarget: 'umd',
      filename: 'main-navbar.js',
      // Add other configurations if needed
    },
  },
};
