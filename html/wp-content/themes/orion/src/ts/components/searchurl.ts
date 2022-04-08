// eslint-disable-next-line @typescript-eslint/explicit-module-boundary-types
export const searchurl = () => {
	const pairs = location.search.slice(1).split('&');
	const result = {};
	pairs.forEach((pair: string) => {
		const pairSplit = pair.split('=');
		result[pairSplit[0]] = decodeURIComponent(pairSplit[1] || '');
	});
	return JSON.parse(JSON.stringify(result));
};