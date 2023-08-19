/** @param {import('@roots/bud').Bud} bud */
export default async (bud) => {
  bud
    .entry({
      app: ['@resources/js/app.js'],
      shortcode: ['@resources/js/shortcode.js']
    })
    .setPath('@resources', '@src/resources/')
    .setPath('@dist', '@src/public/')
    .watch(bud.path(`@src/resources/**/*`))
    .assets({
      from: 'src/resources/images',
      to: 'images',
      context: bud.path()
    })
}
