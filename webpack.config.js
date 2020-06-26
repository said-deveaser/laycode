const path = require('path');
const MiniCSSExtractPlugin = require('mini-css-extract-plugin');
const VueLoaderPlugin = require('vue-loader/lib/plugin');

module.exports = {
    watch: true,
    mode: 'production',
    resolve: {
        extensions: ['.js', '.vue', '.json'],
        alias: {
            'vue$': 'vue/dist/vue.esm.js',
        }
    },
    devServer: {
        port: 3000,
        historyApiFallback: {
          index: 'index.html'
        }
    },
    plugins: [
        new VueLoaderPlugin(),
        new MiniCSSExtractPlugin({
            filename: "[name].css"
        }),
    ],
    entry: {
        dist: './src/index.js',
    },
    output: {
        path: path.resolve(__dirname, "dist"),
        filename: "[name].js",
        publicPath: "/dist/"
    },
    module: {
        rules: [
            {
                test: /\.vue/i,
                use: 'vue-loader'
            },
            {
                test: /\.(eot|ttf|woff)$/i,
                use: {
                    loader: 'file-loader',
                    options: {
                        outputPath: 'fonts',
                        name: '[name].[ext]'
                    }
                }
            },
            {
                test: /\.js/i,
                exclude: /(node_modules)/i,
                use: [
                    {
                        loader: 'babel-loader',
                        options: {
                            presets: ['@babel/preset-env']
                        }

                    }
                ]
            },
            {
                test: /\.s(c|a)ss$/i,
                exclude: /(node_modules)/,
                use: [
                    MiniCSSExtractPlugin.loader,
                    'css-loader',
                    'sass-loader'
                ]
            },
            {
                test: /\.(png|jpe?g|svg|gif)/i,
                use: [
                    {
                        loader: 'file-loader',
                        options: {
                            outputPath: 'img',
                            name: '[name].[ext]'
                        }                    
                    }
                ]
            }

        ]
    }

}