import InteractionType from "./InteractionType";

export default class QuestionType {
    static get SURVEY() {
        return {
            icon: "bar_chart",
            name: "Sondage",
            value: InteractionType.SURVEY,
        };
    }

    static get MCQ() {
        return {
            icon: "rule",
            name: "QCM",
            value: InteractionType.MCQ,
        };
    }

    static get AUDIO() {
        return {
            icon: "mic",
            name: "Audio",
            value: InteractionType.AUDIO,
        };
    }

    static get VIDEO() {
        return {
            icon: "video_call",
            name: "Vidéo",
            value: InteractionType.VIDEO,
        };
    }

    static get PICTURE() {
        return {
            icon: "image",
            name: "Image",
            value: InteractionType.PICTURE,
        };
    }

    static get TEXT() {
        return {
            icon: "subject",
            name: "Texte",
            value: InteractionType.TEXT
        };
    }

    static getAll() {
        return [
            this.SURVEY,
            this.MCQ,
            this.TEXT,
            this.PICTURE,
            this.AUDIO,
            this.VIDEO,
        ];
    }
}
