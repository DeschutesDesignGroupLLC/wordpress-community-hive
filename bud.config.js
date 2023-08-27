/** @param {import('@roots/bud').Bud} bud */
export default async (bud) => {
  bud
    .entry({
      admin: ['@resources/js/admin.js'],
      block: ['@resources/js/block.js'],
      shortcode: ['@resources/js/shortcode.js']
    })
    .setPath('@resources', '@src/resources/')
    .setPath('@dist', '@src/public/')
    .watch(bud.path(`@resources/**/*`))
    .assets({
      from: 'src/resources/images',
      to: 'images',
      context: bud.path()
    })
}
