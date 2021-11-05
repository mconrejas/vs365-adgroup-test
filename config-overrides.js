const { alias } = require('react-app-rewire-alias')

module.exports = function override(config) {
    alias({
        '@components':  'src/components',
        '@atoms':       'src/components/atoms',
        '@molecules':   'src/components/molecules',
        '@organisims':  'src/components/organisims',
        '@templates':   'src/components/templates',
        '@pages':       'src/components/pages',
        '@redux':       'src/redux',
        '@actions':     'src/redux/actions',
        '@reducers':    'src/redux/reducers',
        '@services':    'src/services',
        '@assets':      'src/assets',
        '@utils':       'src/utils',
        '@helpers':     'src/helpers'
    })(config)

    return config
}