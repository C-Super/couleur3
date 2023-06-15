export default class PopupTitleType {
    static get QUESTION() {
        return "QUESTION";
    }

    static get QUICK() {
        return "QUICK";
    }

    static get THANKS() {
        return "THANKS";
    }

    static get GIFT() {
        return "GIFT";
    }

    static isQuestion(type) {
        return (
            type === PopupTitleType.QUESTION ||
            type === PopupTitleType.QUICK ||
            type === PopupTitleType.THANKS ||
            type === PopupTitleType.GIFT
        );
    }
}
