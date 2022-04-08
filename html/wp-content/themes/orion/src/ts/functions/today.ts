// eslint-disable-next-line @typescript-eslint/explicit-module-boundary-types
export const dateTime = () => {
	const today = new Date();
	const date =
		today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
	const time =
		today.getHours() + ':' + today.getMinutes() + ':' + today.getSeconds();
	return date + ' ' + time;
};
