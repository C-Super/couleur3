export default class QuestionType {
    static get SURVEY() {
        return {
            icon: "bar_chart",
            name: "Sondage",
            value: "survey",
        };
    }

    static get MCQ() {
        return {
            icon: "rule",
            name: "QCM",
            value: "mcq",
        };
    }

    static get AUDIO() {
        return {
            icon: "mic",
            name: "Audio",
            value: "audio",
        };
    }

    static get VIDEO() {
        return {
            icon: "video_call",
            name: "Vidéo",
            value: "video",
        };
    }

    static get PICTURE() {
        return {
            icon: "image",
            name: "Image",
            value: "picture",
        };
    }

    static get TEXT() {
        return {
            icon: "subject",
            name: "Texte",
            value: "text",
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
