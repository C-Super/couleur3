const Ziggy = {
    url: "http://localhost",
    port: null,
    defaults: {},
    routes: {
        "debugbar.openhandler": {
            uri: "_debugbar/open",
            methods: ["GET", "HEAD"],
        },
        "debugbar.clockwork": {
            uri: "_debugbar/clockwork/{id}",
            methods: ["GET", "HEAD"],
        },
        "debugbar.assets.css": {
            uri: "_debugbar/assets/stylesheets",
            methods: ["GET", "HEAD"],
        },
        "debugbar.assets.js": {
            uri: "_debugbar/assets/javascript",
            methods: ["GET", "HEAD"],
        },
        "debugbar.cache.delete": {
            uri: "_debugbar/cache/{key}/{tags?}",
            methods: ["DELETE"],
        },
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
        "auditor.messages.store": { uri: "messages", methods: ["POST"] },
        "answer.store": { uri: "answer", methods: ["POST"] },
        "animator.index": { uri: "dashboard", methods: ["GET", "HEAD"] },
        "animator.chat.update": { uri: "dashboard/chat", methods: ["POST"] },
        "animator.interactions.index": {
            uri: "dashboard/interactions",
            methods: ["GET", "HEAD"],
        },
        "animator.interactions.store": {
            uri: "dashboard/interactions",
            methods: ["POST"],
        },
        "animator.interactions.show": {
            uri: "dashboard/interactions/{interaction}",
            methods: ["GET", "HEAD"],
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
