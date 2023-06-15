const Ziggy = {
    url: "http://localhost",
    port: null,
    defaults: {},
    routes: {
        "sanctum.csrf-cookie": {
            uri: "sanctum/csrf-cookie",
            methods: ["GET", "HEAD"],
        },
        "ignition.healthCheck": {
            uri: "_ignition/health-check",
            methods: ["GET", "HEAD"],
        },
        "ignition.executeSolution": {
            uri: "_ignition/execute-solution",
            methods: ["POST"],
        },
        "ignition.updateConfig": {
            uri: "_ignition/update-config",
            methods: ["POST"],
        },
        "auditor.index": { uri: "/", methods: ["GET", "HEAD"] },
        "profile.edit": { uri: "profile", methods: ["GET", "HEAD"] },
        "profile.update": { uri: "profile", methods: ["PATCH"] },
        "profile.destroy": { uri: "profile", methods: ["DELETE"] },
        "messages.store": { uri: "messages", methods: ["POST"] },
        "interactions.answers.cta.store": {
            uri: "interactions/{interaction}/answers/cta",
            methods: ["POST"],
        },
        "interactions.answers.quick_click.store": {
            uri: "interactions/{interaction}/answers/quick_click",
            methods: ["POST"],
            bindings: { interaction: "id" },
        },
        "interactions.answers.survey.store": {
            uri: "interactions/{interaction}/answers/survey",
            methods: ["POST"],
            bindings: { interaction: "id" },
        },
        "interactions.answers.mcq.store": {
            uri: "interactions/{interaction}/answers/mcq",
            methods: ["POST"],
            bindings: { interaction: "id" },
        },
        "interactions.answers.audio.store": {
            uri: "interactions/{interaction}/answers/audio",
            methods: ["POST"],
        },
        "interactions.answers.video.store": {
            uri: "interactions/{interaction}/answers/video",
            methods: ["POST"],
        },
        "interactions.answers.picture.store": {
            uri: "interactions/{interaction}/answers/picture",
            methods: ["POST"],
        },
        "interactions.answers.text.store": {
            uri: "interactions/{interaction}/answers/text",
            methods: ["POST"],
            bindings: { interaction: "id" },
        },
        "animator.index": { uri: "dashboard", methods: ["GET", "HEAD"] },
        "animator.endEmission": { uri: "endEmission", methods: ["POST"] },
        "settings.update": { uri: "settings", methods: ["POST"] },
        "interactions.cta.store": {
            uri: "interactions/cta",
            methods: ["POST"],
        },
        "interactions.quick_click.store": {
            uri: "interactions/quick_click",
            methods: ["POST"],
        },
        "interactions.survey.store": {
            uri: "interactions/survey",
            methods: ["POST"],
        },
        "interactions.mcq.store": {
            uri: "interactions/mcq",
            methods: ["POST"],
        },
        "interactions.audio.store": {
            uri: "interactions/audio",
            methods: ["POST"],
        },
        "interactions.video.store": {
            uri: "interactions/video",
            methods: ["POST"],
        },
        "interactions.picture.store": {
            uri: "interactions/picture",
            methods: ["POST"],
        },
        "interactions.text.store": {
            uri: "interactions/text",
            methods: ["POST"],
        },
        "interactions.end": {
            uri: "interactions/{interaction}/end",
            methods: ["POST"],
            bindings: { interaction: "id" },
        },
        "interactions.winners.random": {
            uri: "interactions/{interaction}/winners/random",
            methods: ["POST"],
            bindings: { interaction: "id" },
        },
        "interactions.winners.replace": {
            uri: "interactions/{interaction}/winners/replace",
            methods: ["POST"],
        },
        "interactions.winners.fastest": {
            uri: "interactions/{interaction}/winners/fastest",
            methods: ["POST"],
            bindings: { interaction: "id" },
        },
        "interactions.winners.confirm": {
            uri: "interactions/{interaction}/winners/confirm",
            methods: ["POST"],
            bindings: { interaction: "id" },
        },
        register: { uri: "register", methods: ["GET", "HEAD"] },
        login: { uri: "login", methods: ["GET", "HEAD"] },
        "password.request": {
            uri: "forgot-password",
            methods: ["GET", "HEAD"],
        },
        "password.email": { uri: "forgot-password", methods: ["POST"] },
        "password.reset": {
            uri: "reset-password/{token}",
            methods: ["GET", "HEAD"],
        },
        "password.store": { uri: "reset-password", methods: ["POST"] },
        "verification.notice": {
            uri: "verify-email",
            methods: ["GET", "HEAD"],
        },
        "verification.verify": {
            uri: "verify-email/{id}/{hash}",
            methods: ["GET", "HEAD"],
        },
        "verification.send": {
            uri: "email/verification-notification",
            methods: ["POST"],
        },
        "password.confirm": {
            uri: "confirm-password",
            methods: ["GET", "HEAD"],
        },
        "password.update": { uri: "password", methods: ["PUT"] },
        logout: { uri: "logout", methods: ["POST"] },
    },
};

if (typeof window !== "undefined" && typeof window.Ziggy !== "undefined") {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}

export { Ziggy };
