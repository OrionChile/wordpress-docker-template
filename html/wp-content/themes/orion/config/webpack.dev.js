/* eslint-disable @typescript-eslint/no-var-requires */
/* eslint-disable no-undef */
const { merge } = require('webpack-merge');
const common = require('./webpack.common.js');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const path = require('path');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const weblocal = 'http://localhost:8000/';

module.exports = merge(common, {
	mode: 'development',
	devtool: 'inline-source-map',
	devServer: {
		contentBase: 'dist',
		overlay: true,
		hot: true,
		stats: {
			colors: true,
		},
	},
	output: {
		filename: '[name]-bundle.js',
		path: path.resolve(__dirname, '../dist'),
		publicPath: '/',
	},
	plugins: [
		new MiniCssExtractPlugin({
			filename: '[name].css',
		}),
		new BrowserSyncPlugin({
			host: 'localhost',
			port: 3000,
			files: ['./**/*.php', './dist/*.js'],
			proxy: weblocal,
		}),
	],
});
