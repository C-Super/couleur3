export default function formatDateToHoursMinutes(d) {
    const date = new Date(d);

    const hours = format_two_digits(date.getHours());
    const minutes = format_two_digits(date.getMinutes());

    return `${hours}:${minutes}`;
}

function format_two_digits(number) {
    return number < 10 ? "0" + number : number;
}
