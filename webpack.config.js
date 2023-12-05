const path = require("path");
const glob = require('glob');

module.exports = {
	mode: "development",
	entry: {
		'mainBundle' : glob.sync('./src/js/modules/*.js'),
		'userTabsBundle': './src/js/modules/user_tabs_manager.js',
		'adminTabsBundle': './src/js/modules/admin_tabs_manager.js'
	},
	output: {
		filename: "[name].js",
		path: path.resolve(__dirname, "dist"),
		clean: true,
		assetModuleFilename: "[name][ext]",
	},
	devServer: {
		static: {
			directory: path.resolve(__dirname, "dist"),
		},
		port: 3001,
		open: true,
		hot: true,
		compress: true,
		historyApiFallback: true,
	},
	module: {
		rules: [
			{
				test: /\.css$/i,
				include: path.resolve(__dirname, "./src"),
				use: ["style-loader", "css-loader", "postcss-loader"],
			},
			{
				test: /\.(png|svg|jpg|jpeg|gif)$/i,
				type: "asset/resource",
			},
		],
	},
	plugins: [
	],
};
