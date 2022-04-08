/* eslint-disable @typescript-eslint/no-var-requires */
/* eslint-disable no-undef */
const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const { merge } = require('webpack-merge');
const common = require('./webpack.common.js');

module.exports = merge(common, {
	mode: 'production',
	devtool: 'source-map',
	optimization: {
		minimize: true,
	},
	output: {
		filename: '[name]-bundle-[fullhash:8].js',
		path: path.resolve(__dirname, '../dist'),
		publicPath: '/',
	},
	plugins: [
		new MiniCssExtractPlugin({
			filename: '[name]-[fullhash:8].css',
		}),
	],
});
