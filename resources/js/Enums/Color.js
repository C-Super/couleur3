import InteractionType from "./InteractionType";

export default class Color {
    static get PRIMARY() {
        return "primary";
    }

    static get SECONDARY() {
        return "secondary";
    }

    static get ACCENT() {
        return "accent";
    }

    static get SUCCESS() {
        return "success";
    }

    static get ERROR() {
        return "error";
    }

    static get DANGER() {
        return "error";
    }

    static get WARNING() {
        return "warning";
    }

    static get INFO() {
        return "info";
    }

    static get WHITE() {
        return "white";
    }

    static forInteractionType(type) {
        switch (type) {
            case InteractionType.isQuestion(type):
                return Color.PRIMARY;
            case InteractionType.CTA:
                return Color.SECONDARY;
            case InteractionType.QUICK_CLICK:
                return Color.ACCENT;
            default:
                return Color.PRIMARY;
        }
    }
}
