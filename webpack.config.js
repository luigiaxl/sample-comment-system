const path = require('path');

module.exports = {
    devServer: {
        host: '0.0.0.0',
        port: 8080,
    },
    resolve: {
        alias: {
            '@': path.resolve('resources/js'),
        },
    },
};
