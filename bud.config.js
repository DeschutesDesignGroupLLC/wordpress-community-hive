/** @param {import('@roots/bud').Bud} bud */
export default async bud => {
    bud.entry('app', ['resources/js/app.js'])
    bud.setPath('@dist', '@src/public')
    bud.watch(bud.path(`@src/resources/**/*`))
    bud.assets({
        from: 'src/resources/images',
        to: 'images',
        context: bud.path()
    })
}