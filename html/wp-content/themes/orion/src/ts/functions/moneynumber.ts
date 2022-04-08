export function numberToMoney(number: number): string {
	return '$' + number.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
}

export function moneyToNumber(money: string): number {
	return parseInt(
		money
			.replace(',', '')
			.replace(',', '')
			.replace('.', '')
			.replace('.', '')
			.replace('.', '')
			.replace('$', '')
	);
}
