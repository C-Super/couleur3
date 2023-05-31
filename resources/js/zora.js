const Zora = {
    translations: {
        en: {
            php: {
                auth: {
                    failed: "These credentials do not match our records.",
                    password: "The password is incorrect.",
                    throttle:
                        "Too many login attempts. Please try again in :seconds seconds.",
                },
                "http-statuses": {
                    0: "Unknown Error",
                    100: "Continue",
                    101: "Switching Protocols",
                    102: "Processing",
                    200: "OK",
                    201: "Created",
                    202: "Accepted",
                    203: "Non-Authoritative Information",
                    204: "No Content",
                    205: "Reset Content",
                    206: "Partial Content",
                    207: "Multi-Status",
                    208: "Already Reported",
                    226: "IM Used",
                    300: "Multiple Choices",
                    301: "Moved Permanently",
                    302: "Found",
                    303: "See Other",
                    304: "Not Modified",
                    305: "Use Proxy",
                    307: "Temporary Redirect",
                    308: "Permanent Redirect",
                    400: "Bad Request",
                    401: "Unauthorized",
                    402: "Payment Required",
                    403: "Forbidden",
                    404: "Not Found",
                    405: "Method Not Allowed",
                    406: "Not Acceptable",
                    407: "Proxy Authentication Required",
                    408: "Request Timeout",
                    409: "Conflict",
                    410: "Gone",
                    411: "Length Required",
                    412: "Precondition Failed",
                    413: "Payload Too Large",
                    414: "URI Too Long",
                    415: "Unsupported Media Type",
                    416: "Range Not Satisfiable",
                    417: "Expectation Failed",
                    418: "I'm a teapot",
                    419: "Session Has Expired",
                    421: "Misdirected Request",
                    422: "Unprocessable Entity",
                    423: "Locked",
                    424: "Failed Dependency",
                    425: "Too Early",
                    426: "Upgrade Required",
                    428: "Precondition Required",
                    429: "Too Many Requests",
                    431: "Request Header Fields Too Large",
                    444: "Connection Closed Without Response",
                    449: "Retry With",
                    451: "Unavailable For Legal Reasons",
                    499: "Client Closed Request",
                    500: "Internal Server Error",
                    501: "Not Implemented",
                    502: "Bad Gateway",
                    503: "Maintenance Mode",
                    504: "Gateway Timeout",
                    505: "HTTP Version Not Supported",
                    506: "Variant Also Negotiates",
                    507: "Insufficient Storage",
                    508: "Loop Detected",
                    509: "Bandwidth Limit Exceeded",
                    510: "Not Extended",
                    511: "Network Authentication Required",
                    520: "Unknown Error",
                    521: "Web Server is Down",
                    522: "Connection Timed Out",
                    523: "Origin Is Unreachable",
                    524: "A Timeout Occurred",
                    525: "SSL Handshake Failed",
                    526: "Invalid SSL Certificate",
                    527: "Railgun Error",
                    598: "Network Read Timeout Error",
                    599: "Network Connect Timeout Error",
                    unknownError: "Unknown Error",
                },
                pagination: {
                    previous: "&laquo; Previous",
                    next: "Next &raquo;",
                },
                passwords: {
                    reset: "Your password has been reset!",
                    sent: "We have emailed your password reset link!",
                    throttled: "Please wait before retrying.",
                    token: "This password reset token is invalid.",
                    user: "We can't find a user with that email address.",
                },
                validation: {
                    accepted: "The :attribute must be accepted.",
                    accepted_if:
                        "The :attribute must be accepted when :other is :value.",
                    active_url: "The :attribute is not a valid URL.",
                    after: "The :attribute must be a date after :date.",
                    after_or_equal:
                        "The :attribute must be a date after or equal to :date.",
                    alpha: "The :attribute may only contain letters.",
                    alpha_dash:
                        "The :attribute may only contain letters, numbers, and dashes.",
                    alpha_num:
                        "The :attribute may only contain letters and numbers.",
                    array: "The :attribute must be an array.",
                    ascii: "The :attribute must only contain single-byte alphanumeric characters and symbols.",
                    before: "The :attribute must be a date before :date.",
                    before_or_equal:
                        "The :attribute must be a date before or equal to :date.",
                    between: {
                        array: "The :attribute must have between :min and :max items.",
                        file: "The :attribute must be between :min and :max kilobytes.",
                        numeric:
                            "The :attribute must be between :min and :max.",
                        string: "The :attribute must be between :min and :max characters.",
                    },
                    boolean: "The :attribute field must be true or false.",
                    confirmed: "The :attribute confirmation does not match.",
                    current_password: "The password is incorrect.",
                    date: "The :attribute is not a valid date.",
                    date_equals:
                        "The :attribute must be a date equal to :date.",
                    date_format:
                        "The :attribute does not match the format :format.",
                    decimal:
                        "The :attribute must have :decimal decimal places.",
                    declined: "The :attribute must be declined.",
                    declined_if:
                        "The :attribute must be declined when :other is :value.",
                    different: "The :attribute and :other must be different.",
                    digits: "The :attribute must be :digits digits.",
                    digits_between:
                        "The :attribute must be between :min and :max digits.",
                    dimensions: "The :attribute has invalid image dimensions.",
                    distinct: "The :attribute field has a duplicate value.",
                    doesnt_end_with:
                        "The :attribute may not end with one of the following: :values.",
                    doesnt_start_with:
                        "The :attribute may not start with one of the following: :values.",
                    email: "The :attribute must be a valid email address.",
                    ends_with:
                        "The :attribute must end with one of the following: :values.",
                    enum: "The selected :attribute is invalid.",
                    exists: "The selected :attribute is invalid.",
                    file: "The :attribute must be a file.",
                    filled: "The :attribute field is required.",
                    gt: {
                        array: "The :attribute must have more than :value items.",
                        file: "The :attribute must be greater than :value kilobytes.",
                        numeric: "The :attribute must be greater than :value.",
                        string: "The :attribute must be greater than :value characters.",
                    },
                    gte: {
                        array: "The :attribute must have :value items or more.",
                        file: "The :attribute must be greater than or equal :value kilobytes.",
                        numeric:
                            "The :attribute must be greater than or equal :value.",
                        string: "The :attribute must be greater than or equal :value characters.",
                    },
                    image: "The :attribute must be an image.",
                    in: "The selected :attribute is invalid.",
                    in_array: "The :attribute field does not exist in :other.",
                    integer: "The :attribute must be an integer.",
                    ip: "The :attribute must be a valid IP address.",
                    ipv4: "The :attribute must be a valid IPv4 address.",
                    ipv6: "The :attribute must be a valid IPv6 address.",
                    json: "The :attribute must be a valid JSON string.",
                    lowercase: "The :attribute must be lowercase.",
                    lt: {
                        array: "The :attribute must have less than :value items.",
                        file: "The :attribute must be less than :value kilobytes.",
                        numeric: "The :attribute must be less than :value.",
                        string: "The :attribute must be less than :value characters.",
                    },
                    lte: {
                        array: "The :attribute must not have more than :value items.",
                        file: "The :attribute must be less than or equal :value kilobytes.",
                        numeric:
                            "The :attribute must be less than or equal :value.",
                        string: "The :attribute must be less than or equal :value characters.",
                    },
                    mac_address: "The :attribute must be a valid MAC address.",
                    max: {
                        array: "The :attribute may not have more than :max items.",
                        file: "The :attribute may not be greater than :max kilobytes.",
                        numeric: "The :attribute may not be greater than :max.",
                        string: "The :attribute may not be greater than :max characters.",
                    },
                    max_digits:
                        "The :attribute must not have more than :max digits.",
                    mimes: "The :attribute must be a file of type: :values.",
                    mimetypes:
                        "The :attribute must be a file of type: :values.",
                    min: {
                        array: "The :attribute must have at least :min items.",
                        file: "The :attribute must be at least :min kilobytes.",
                        numeric: "The :attribute must be at least :min.",
                        string: "The :attribute must be at least :min characters.",
                    },
                    min_digits:
                        "The :attribute must have at least :min digits.",
                    missing: "The :attribute field must be missing.",
                    missing_if:
                        "The :attribute field must be missing when :other is :value.",
                    missing_unless:
                        "The :attribute field must be missing unless :other is :value.",
                    missing_with:
                        "The :attribute field must be missing when :values is present.",
                    missing_with_all:
                        "The :attribute field must be missing when :values are present.",
                    multiple_of: "The :attribute must be a multiple of :value.",
                    not_in: "The selected :attribute is invalid.",
                    not_regex: "The :attribute format is invalid.",
                    numeric: "The :attribute must be a number.",
                    password: {
                        letters:
                            "The :attribute must contain at least one letter.",
                        mixed: "The :attribute must contain at least one uppercase and one lowercase letter.",
                        numbers:
                            "The :attribute must contain at least one number.",
                        symbols:
                            "The :attribute must contain at least one symbol.",
                        uncompromised:
                            "The given :attribute has appeared in a data leak. Please choose a different :attribute.",
                    },
                    present: "The :attribute field must be present.",
                    prohibited: "The :attribute field is prohibited.",
                    prohibited_if:
                        "The :attribute field is prohibited when :other is :value.",
                    prohibited_unless:
                        "The :attribute field is prohibited unless :other is in :values.",
                    prohibits:
                        "The :attribute field prohibits :other from being present.",
                    regex: "The :attribute format is invalid.",
                    required: "The :attribute field is required.",
                    required_array_keys:
                        "The :attribute field must contain entries for: :values.",
                    required_if:
                        "The :attribute field is required when :other is :value.",
                    required_if_accepted:
                        "The :attribute field is required when :other is accepted.",
                    required_unless:
                        "The :attribute field is required unless :other is in :values.",
                    required_with:
                        "The :attribute field is required when :values is present.",
                    required_with_all:
                        "The :attribute field is required when :values is present.",
                    required_without:
                        "The :attribute field is required when :values is not present.",
                    required_without_all:
                        "The :attribute field is required when none of :values are present.",
                    same: "The :attribute and :other must match.",
                    size: {
                        array: "The :attribute must contain :size items.",
                        file: "The :attribute must be :size kilobytes.",
                        numeric: "The :attribute must be :size.",
                        string: "The :attribute must be :size characters.",
                    },
                    starts_with:
                        "The :attribute must start with one of the following: :values",
                    string: "The :attribute must be a string.",
                    timezone: "The :attribute must be a valid zone.",
                    unique: "The :attribute has already been taken.",
                    uploaded: "The :attribute failed to upload.",
                    uppercase: "The :attribute must be uppercase.",
                    url: "The :attribute format is invalid.",
                    ulid: "The :attribute must be a valid ULID.",
                    uuid: "The :attribute must be a valid UUID.",
                    custom: {
                        "attribute-name": { "rule-name": "custom-message" },
                    },
                    attributes: {
                        address: "address",
                        age: "age",
                        amount: "amount",
                        area: "area",
                        available: "available",
                        birthday: "birthday",
                        body: "body",
                        city: "city",
                        content: "content",
                        country: "country",
                        created_at: "created at",
                        creator: "creator",
                        current_password: "current password",
                        date: "date",
                        date_of_birth: "date of birth",
                        day: "day",
                        deleted_at: "deleted at",
                        description: "description",
                        district: "district",
                        duration: "duration",
                        email: "email",
                        excerpt: "excerpt",
                        filter: "filter",
                        first_name: "first name",
                        gender: "gender",
                        group: "group",
                        hour: "hour",
                        image: "image",
                        last_name: "last name",
                        lesson: "lesson",
                        line_address_1: "line address 1",
                        line_address_2: "line address 2",
                        message: "message",
                        middle_name: "middle name",
                        minute: "minute",
                        mobile: "mobile",
                        month: "month",
                        name: "name",
                        national_code: "national code",
                        number: "number",
                        password: "password",
                        password_confirmation: "password confirmation",
                        phone: "phone",
                        photo: "photo",
                        postal_code: "postal code",
                        price: "price",
                        province: "province",
                        recaptcha_response_field: "recaptcha response field",
                        remember: "remember",
                        restored_at: "restored at",
                        result_text_under_image: "result text under image",
                        role: "role",
                        second: "second",
                        sex: "sex",
                        short_text: "short text",
                        size: "size",
                        state: "state",
                        street: "street",
                        student: "student",
                        subject: "subject",
                        teacher: "teacher",
                        terms: "terms",
                        test_description: "test description",
                        test_locale: "test locale",
                        test_name: "test name",
                        text: "text",
                        time: "time",
                        title: "title",
                        updated_at: "updated at",
                        username: "username",
                        year: "year",
                    },
                },
            },
            json: {
                "(and :count more error)": "(and :count more error)",
                "(and :count more errors)": "(and :count more errors)",
                "A new verification link has been sent to the email address you provided during registration.":
                    "A new verification link has been sent to the email address you provided during registration.",
                "A new verification link has been sent to your email address.":
                    "A new verification link has been sent to your email address.",
                "All rights reserved.": "All rights reserved.",
                "Already registered?": "Already registered?",
                "Are you sure you want to delete your account?":
                    "Are you sure you want to delete your account?",
                Cancel: "Cancel",
                "Click here to re-send the verification email.":
                    "Click here to re-send the verification email.",
                Confirm: "Confirm",
                "Confirm Password": "Confirm Password",
                "Current Password": "Current Password",
                Dashboard: "Dashboard",
                "Delete Account": "Delete Account",
                Email: "Email",
                "Email Password Reset Link": "Email Password Reset Link",
                "Ensure your account is using a long, random password to stay secure.":
                    "Ensure your account is using a long, random password to stay secure.",
                Forbidden: "Forbidden",
                "Forgot your password?": "Forgot your password?",
                "Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.":
                    "Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.",
                "Go to page :page": "Go to page :page",
                "Hello!": "Hello!",
                "If you did not create an account, no further action is required.":
                    "If you did not create an account, no further action is required.",
                "If you did not request a password reset, no further action is required.":
                    "If you did not request a password reset, no further action is required.",
                'If you\'re having trouble clicking the ":actionText" button, copy and paste the URL below\ninto your web browser:':
                    'If you\'re having trouble clicking the ":actionText" button, copy and paste the URL below\ninto your web browser:',
                "Log in": "Log in",
                "Log Out": "Log Out",
                Login: "Login",
                Logout: "Logout",
                Name: "Name",
                "New Password": "New Password",
                "Not Found": "Not Found",
                of: "of",
                "Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.":
                    "Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.",
                "Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.":
                    "Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.",
                "Page Expired": "Page Expired",
                "Pagination Navigation": "Pagination Navigation",
                Password: "Password",
                "Payment Required": "Payment Required",
                "Please click the button below to verify your email address.":
                    "Please click the button below to verify your email address.",
                Profile: "Profile",
                "Profile Information": "Profile Information",
                Regards: "Regards",
                Register: "Register",
                "Remember me": "Remember me",
                "Resend Verification Email": "Resend Verification Email",
                "Reset Password": "Reset Password",
                "Reset Password Notification": "Reset Password Notification",
                results: "results",
                Save: "Save",
                "Saved.": "Saved.",
                "Server Error": "Server Error",
                "Service Unavailable": "Service Unavailable",
                Showing: "Showing",
                "Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.":
                    "Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.",
                "The given data was invalid.": "The given data was invalid.",
                "This is a secure area of the application. Please confirm your password before continuing.":
                    "This is a secure area of the application. Please confirm your password before continuing.",
                "This password reset link will expire in :count minutes.":
                    "This password reset link will expire in :count minutes.",
                to: "to",
                "Toggle navigation": "Toggle navigation",
                "Too Many Requests": "Too Many Requests",
                Unauthorized: "Unauthorized",
                "Update Password": "Update Password",
                "Update your account's profile information and email address.":
                    "Update your account's profile information and email address.",
                "Verify Email Address": "Verify Email Address",
                "Whoops!": "Whoops!",
                "You are receiving this email because we received a password reset request for your account.":
                    "You are receiving this email because we received a password reset request for your account.",
                "You're logged in!": "You're logged in!",
                "Your email address is unverified.":
                    "Your email address is unverified.",
            },
        },
        fr: {
            php: {
                auth: {
                    failed: "Ces identifiants ne correspondent pas \u00e0 nos enregistrements.",
                    password: "Le mot de passe est incorrect",
                    throttle:
                        "Tentatives de connexion trop nombreuses. Veuillez essayer de nouveau dans :seconds secondes.",
                },
                "http-statuses": {
                    0: "Erreur inconnue",
                    100: "Continuer",
                    101: "Protocoles de commutation",
                    102: "En traitement",
                    200: "D'accord",
                    201: "Cr\u00e9\u00e9",
                    202: "Accept\u00e9",
                    203: "Informations non autoris\u00e9es",
                    204: "Pas content",
                    205: "R\u00e9initialiser le contenu",
                    206: "Contenu partiel",
                    207: "Multi-statut",
                    208: "D\u00e9j\u00e0 rapport\u00e9",
                    226: "J'ai l'habitude",
                    300: "Choix multiples",
                    301: "D\u00e9plac\u00e9 de fa\u00e7on permanente",
                    302: "A trouv\u00e9",
                    303: "Voir autre",
                    304: "Non modifi\u00e9",
                    305: "Utiliser un proxy",
                    307: "Redirection temporaire",
                    308: "Redirection permanente",
                    400: "Mauvaise Demande",
                    401: "Non autoris\u00e9",
                    402: "Paiement Requis",
                    403: "Interdit",
                    404: "Page non trouv\u00e9e",
                    405: "M\u00e9thode Non Autoris\u00e9e",
                    406: "Pas acceptable",
                    407: "Authentification proxy requise",
                    408: "D\u00e9lai d'expiration de la demande",
                    409: "Conflit",
                    410: "Disparu",
                    411: "Longueur requise",
                    412: "La pr\u00e9condition a \u00e9chou\u00e9",
                    413: "Charge utile trop grande",
                    414: "URI trop long",
                    415: "Type de support non support\u00e9",
                    416: "Plage non satisfaisante",
                    417: "\u00c9chec de l'attente",
                    418: "Je suis une th\u00e9i\u00e8re",
                    419: "La session a expir\u00e9",
                    421: "Demande mal dirig\u00e9e",
                    422: "Entit\u00e9 non traitable",
                    423: "Ferm\u00e9 \u00e0 clef",
                    424: "D\u00e9pendance \u00e9chou\u00e9e",
                    425: "Trop t\u00f4t",
                    426: "Mise \u00e0 niveau requise",
                    428: "Condition pr\u00e9alable requise",
                    429: "Trop de demandes",
                    431: "Demander des champs d'en-t\u00eate trop grands",
                    444: "Connexion ferm\u00e9e sans r\u00e9ponse",
                    449: "R\u00e9essayer avec",
                    451: "Indisponible pour des raisons l\u00e9gales",
                    499: "Demande ferm\u00e9e du client",
                    500: "Erreur Interne du Serveur",
                    501: "Pas mis en \u0153uvre",
                    502: "Mauvaise passerelle",
                    503: "Mode de Maintenance",
                    504: "D\u00e9lai d'attente de la passerelle",
                    505: "Version HTTP non prise en charge",
                    506: "La variante n\u00e9gocie \u00e9galement",
                    507: "Espace insuffisant",
                    508: "Boucle d\u00e9tect\u00e9e",
                    509: "Limite de bande passante d\u00e9pass\u00e9e",
                    510: "Non prolong\u00e9",
                    511: "Authentification r\u00e9seau requise",
                    520: "Erreur inconnue",
                    521: "Le serveur Web est en panne",
                    522: "La connexion a expir\u00e9",
                    523: "L'origine est inaccessible",
                    524: "Un d\u00e9passement de d\u00e9lai s'est produit",
                    525: "\u00c9chec de la prise de contact SSL",
                    526: "Certificat SSL invalide",
                    527: "Erreur de canon ferroviaire",
                    598: "Erreur de d\u00e9lai de lecture r\u00e9seau",
                    599: "Erreur de d\u00e9lai de connexion r\u00e9seau",
                    unknownError: "Erreur inconnue",
                },
                pagination: {
                    next: "Suivant &raquo;",
                    previous: "&laquo; Pr\u00e9c\u00e9dent",
                },
                passwords: {
                    reset: "Votre mot de passe a \u00e9t\u00e9 r\u00e9initialis\u00e9 !",
                    sent: "Nous vous avons envoy\u00e9 par email le lien de r\u00e9initialisation du mot de passe !",
                    throttled: "Veuillez patienter avant de r\u00e9essayer.",
                    token: "Ce jeton de r\u00e9initialisation du mot de passe n'est pas valide.",
                    user: "Aucun utilisateur n'a \u00e9t\u00e9 trouv\u00e9 avec cette adresse email.",
                },
                validation: {
                    accepted:
                        "Le champ :attribute doit \u00eatre accept\u00e9.",
                    accepted_if:
                        "Le champ :attribute doit \u00eatre accept\u00e9 quand :other a la valeur :value.",
                    active_url: "Le champ :attribute n'est pas une URL valide.",
                    after: "Le champ :attribute doit \u00eatre une date post\u00e9rieure au :date.",
                    after_or_equal:
                        "Le champ :attribute doit \u00eatre une date post\u00e9rieure ou \u00e9gale au :date.",
                    alpha: "Le champ :attribute doit contenir uniquement des lettres.",
                    alpha_dash:
                        "Le champ :attribute doit contenir uniquement des lettres, des chiffres et des tirets.",
                    alpha_num:
                        "Le champ :attribute doit contenir uniquement des chiffres et des lettres.",
                    array: "Le champ :attribute doit \u00eatre un tableau.",
                    ascii: "Le champ :attribute ne doit contenir que des caract\u00e8res alphanum\u00e9riques et des symboles cod\u00e9s sur un octet.",
                    before: "Le champ :attribute doit \u00eatre une date ant\u00e9rieure au :date.",
                    before_or_equal:
                        "Le champ :attribute doit \u00eatre une date ant\u00e9rieure ou \u00e9gale au :date.",
                    between: {
                        array: "Le tableau :attribute doit contenir entre :min et :max \u00e9l\u00e9ments.",
                        file: "La taille du fichier de :attribute doit \u00eatre comprise entre :min et :max kilo-octets.",
                        numeric:
                            "La valeur de :attribute doit \u00eatre comprise entre :min et :max.",
                        string: "Le texte :attribute doit contenir entre :min et :max caract\u00e8res.",
                    },
                    boolean: "Le champ :attribute doit \u00eatre vrai ou faux.",
                    confirmed:
                        "Le champ de confirmation :attribute ne correspond pas.",
                    current_password: "Le mot de passe est incorrect.",
                    date: "Le champ :attribute n'est pas une date valide.",
                    date_equals:
                        "Le champ :attribute doit \u00eatre une date \u00e9gale \u00e0 :date.",
                    date_format:
                        "Le champ :attribute ne correspond pas au format :format.",
                    decimal:
                        "Le champ :attribute doit comporter :decimal d\u00e9cimales.",
                    declined:
                        "Le champ :attribute doit \u00eatre d\u00e9clin\u00e9.",
                    declined_if:
                        "Le champ :attribute doit \u00eatre d\u00e9clin\u00e9 quand :other a la valeur :value.",
                    different:
                        "Les champs :attribute et :other doivent \u00eatre diff\u00e9rents.",
                    digits: "Le champ :attribute doit contenir :digits chiffres.",
                    digits_between:
                        "Le champ :attribute doit contenir entre :min et :max chiffres.",
                    dimensions:
                        "La taille de l'image :attribute n'est pas conforme.",
                    distinct: "Le champ :attribute a une valeur en double.",
                    doesnt_end_with:
                        "Le champ :attribute ne doit pas finir avec une des valeurs suivantes : :values.",
                    doesnt_start_with:
                        "Le champ :attribute ne doit pas commencer avec une des valeurs suivantes : :values.",
                    email: "Le champ :attribute doit \u00eatre une adresse e-mail valide.",
                    ends_with:
                        "Le champ :attribute doit se terminer par une des valeurs suivantes : :values",
                    enum: "Le champ :attribute s\u00e9lectionn\u00e9 est invalide.",
                    exists: "Le champ :attribute s\u00e9lectionn\u00e9 est invalide.",
                    file: "Le champ :attribute doit \u00eatre un fichier.",
                    filled: "Le champ :attribute doit avoir une valeur.",
                    gt: {
                        array: "Le tableau :attribute doit contenir plus de :value \u00e9l\u00e9ments.",
                        file: "La taille du fichier de :attribute doit \u00eatre sup\u00e9rieure \u00e0 :value kilo-octets.",
                        numeric:
                            "La valeur de :attribute doit \u00eatre sup\u00e9rieure \u00e0 :value.",
                        string: "Le texte :attribute doit contenir plus de :value caract\u00e8res.",
                    },
                    gte: {
                        array: "Le tableau :attribute doit contenir au moins :value \u00e9l\u00e9ments.",
                        file: "La taille du fichier de :attribute doit \u00eatre sup\u00e9rieure ou \u00e9gale \u00e0 :value kilo-octets.",
                        numeric:
                            "La valeur de :attribute doit \u00eatre sup\u00e9rieure ou \u00e9gale \u00e0 :value.",
                        string: "Le texte :attribute doit contenir au moins :value caract\u00e8res.",
                    },
                    image: "Le champ :attribute doit \u00eatre une image.",
                    in: "Le champ :attribute est invalide.",
                    in_array: "Le champ :attribute n'existe pas dans :other.",
                    integer: "Le champ :attribute doit \u00eatre un entier.",
                    ip: "Le champ :attribute doit \u00eatre une adresse IP valide.",
                    ipv4: "Le champ :attribute doit \u00eatre une adresse IPv4 valide.",
                    ipv6: "Le champ :attribute doit \u00eatre une adresse IPv6 valide.",
                    json: "Le champ :attribute doit \u00eatre un document JSON valide.",
                    lowercase:
                        "Le champ :attribute doit \u00eatre en minuscules.",
                    lt: {
                        array: "Le tableau :attribute doit contenir moins de :value \u00e9l\u00e9ments.",
                        file: "La taille du fichier de :attribute doit \u00eatre inf\u00e9rieure \u00e0 :value kilo-octets.",
                        numeric:
                            "La valeur de :attribute doit \u00eatre inf\u00e9rieure \u00e0 :value.",
                        string: "Le texte :attribute doit contenir moins de :value caract\u00e8res.",
                    },
                    lte: {
                        array: "Le tableau :attribute doit contenir au plus :value \u00e9l\u00e9ments.",
                        file: "La taille du fichier de :attribute doit \u00eatre inf\u00e9rieure ou \u00e9gale \u00e0 :value kilo-octets.",
                        numeric:
                            "La valeur de :attribute doit \u00eatre inf\u00e9rieure ou \u00e9gale \u00e0 :value.",
                        string: "Le texte :attribute doit contenir au plus :value caract\u00e8res.",
                    },
                    mac_address:
                        "Le champ :attribute doit \u00eatre une adresse MAC valide.",
                    max: {
                        array: "Le tableau :attribute ne peut pas contenir plus que :max \u00e9l\u00e9ments.",
                        file: "La taille du fichier de :attribute ne peut pas d\u00e9passer :max kilo-octets.",
                        numeric:
                            "La valeur de :attribute ne peut pas \u00eatre sup\u00e9rieure \u00e0 :max.",
                        string: "Le texte de :attribute ne peut pas contenir plus de :max caract\u00e8res.",
                    },
                    max_digits:
                        "Le champ :attribute ne doit pas avoir plus de :max chiffres.",
                    mimes: "Le champ :attribute doit \u00eatre un fichier de type : :values.",
                    mimetypes:
                        "Le champ :attribute doit \u00eatre un fichier de type : :values.",
                    min: {
                        array: "Le tableau :attribute doit contenir au moins :min \u00e9l\u00e9ments.",
                        file: "La taille du fichier de :attribute doit \u00eatre sup\u00e9rieure ou \u00e9gale \u00e0 :min kilo-octets.",
                        numeric:
                            "La valeur de :attribute doit \u00eatre sup\u00e9rieure ou \u00e9gale \u00e0 :min.",
                        string: "Le texte de :attribute doit contenir au moins :min caract\u00e8res.",
                    },
                    min_digits:
                        "Le champ :attribute doit avoir au moins :min chiffres.",
                    missing: "Le champ :attribute doit \u00eatre manquant.",
                    missing_if:
                        "Le champ :attribute doit \u00eatre manquant quand :other a la valeur :value.",
                    missing_unless:
                        "Le champ :attribute doit \u00eatre manquant sauf si :other a la valeur :value.",
                    missing_with:
                        "Le champ :attribute doit \u00eatre manquant quand :values est pr\u00e9sent.",
                    missing_with_all:
                        "Le champ :attribute doit \u00eatre manquant quand :values sont pr\u00e9sents.",
                    multiple_of:
                        "La valeur de :attribute doit \u00eatre un multiple de :value",
                    not_in: "Le champ :attribute s\u00e9lectionn\u00e9 n'est pas valide.",
                    not_regex:
                        "Le format du champ :attribute n'est pas valide.",
                    numeric: "Le champ :attribute doit contenir un nombre.",
                    password: {
                        letters:
                            "Le champ :attribute doit contenir au moins une lettre.",
                        mixed: "Le champ :attribute doit contenir au moins une majuscule et une minuscule.",
                        numbers:
                            "Le champ :attribute doit contenir au moins un chiffre.",
                        symbols:
                            "Le champ :attribute doit contenir au moins un symbole.",
                        uncompromised:
                            "La valeur du champ :attribute est apparue dans une fuite de donn\u00e9es. Veuillez choisir une valeur diff\u00e9rente.",
                    },
                    present: "Le champ :attribute doit \u00eatre pr\u00e9sent.",
                    prohibited: "Le champ :attribute est interdit.",
                    prohibited_if:
                        "Le champ :attribute est interdit quand :other a la valeur :value.",
                    prohibited_unless:
                        "Le champ :attribute est interdit \u00e0 moins que :other est l'une des valeurs :values.",
                    prohibits:
                        "Le champ :attribute interdit :other d'\u00eatre pr\u00e9sent.",
                    regex: "Le format du champ :attribute est invalide.",
                    required: "Le champ :attribute est obligatoire.",
                    required_array_keys:
                        "Le champ :attribute doit contenir des entr\u00e9es pour : :values.",
                    required_if:
                        "Le champ :attribute est obligatoire quand la valeur de :other est :value.",
                    required_if_accepted:
                        "Le champ :attribute est obligatoire quand le champ :other a \u00e9t\u00e9 accept\u00e9.",
                    required_unless:
                        "Le champ :attribute est obligatoire sauf si :other est :values.",
                    required_with:
                        "Le champ :attribute est obligatoire quand :values est pr\u00e9sent.",
                    required_with_all:
                        "Le champ :attribute est obligatoire quand :values sont pr\u00e9sents.",
                    required_without:
                        "Le champ :attribute est obligatoire quand :values n'est pas pr\u00e9sent.",
                    required_without_all:
                        "Le champ :attribute est requis quand aucun de :values n'est pr\u00e9sent.",
                    same: "Les champs :attribute et :other doivent \u00eatre identiques.",
                    size: {
                        array: "Le tableau :attribute doit contenir :size \u00e9l\u00e9ments.",
                        file: "La taille du fichier de :attribute doit \u00eatre de :size kilo-octets.",
                        numeric:
                            "La valeur de :attribute doit \u00eatre :size.",
                        string: "Le texte de :attribute doit contenir :size caract\u00e8res.",
                    },
                    starts_with:
                        "Le champ :attribute doit commencer avec une des valeurs suivantes : :values",
                    string: "Le champ :attribute doit \u00eatre une cha\u00eene de caract\u00e8res.",
                    timezone:
                        "Le champ :attribute doit \u00eatre un fuseau horaire valide.",
                    ulid: "Le champ :attribute doit \u00eatre un ULID valide.",
                    unique: "La valeur du champ :attribute est d\u00e9j\u00e0 utilis\u00e9e.",
                    uploaded:
                        "Le fichier du champ :attribute n'a pu \u00eatre t\u00e9l\u00e9vers\u00e9.",
                    uppercase:
                        "Le champ :attribute doit \u00eatre en majuscules.",
                    url: "Le format de l'URL de :attribute n'est pas valide.",
                    uuid: "Le champ :attribute doit \u00eatre un UUID valide",
                    attributes: {
                        address: "adresse",
                        age: "\u00e2ge",
                        amount: "montant",
                        area: "zone",
                        available: "disponible",
                        birthday: "anniversaire",
                        body: "corps",
                        city: "ville",
                        content: "contenu",
                        country: "pays",
                        created_at: "cr\u00e9\u00e9 \u00e0",
                        creator: "cr\u00e9ateur",
                        current_password: "mot de passe actuel",
                        date: "Date",
                        date_of_birth: "date de naissance",
                        day: "jour",
                        deleted_at: "supprim\u00e9 \u00e0",
                        description: "la description",
                        district: "quartier",
                        duration: "dur\u00e9e",
                        email: "adresse e-mail",
                        excerpt: "extrait",
                        filter: "filtre",
                        first_name: "pr\u00e9nom",
                        gender: "genre",
                        group: "groupe",
                        hour: "heure",
                        image: "image",
                        last_name: "nom",
                        lesson: "le\u00e7on",
                        line_address_1: "ligne d'adresse 1",
                        line_address_2: "ligne d'adresse 2",
                        message: "message",
                        middle_name: "deuxi\u00e8me pr\u00e9nom",
                        minute: "minute",
                        mobile: "portable",
                        month: "mois",
                        name: "nom",
                        national_code: "code national",
                        number: "num\u00e9ro",
                        password: "mot de passe",
                        password_confirmation: "confirmation du mot de passe",
                        phone: "t\u00e9l\u00e9phone",
                        photo: "photo",
                        postal_code: "code postal",
                        price: "prix",
                        province: "r\u00e9gion",
                        recaptcha_response_field:
                            "champ de r\u00e9ponse recaptcha",
                        remember: "se souvenir",
                        restored_at: "restaur\u00e9 \u00e0",
                        result_text_under_image:
                            "texte de r\u00e9sultat sous l'image",
                        role: "r\u00f4le",
                        second: "seconde",
                        sex: "sexe",
                        short_text: "texte court",
                        size: "taille",
                        state: "\u00e9tat",
                        street: "rue",
                        student: "\u00e9tudiant",
                        subject: "sujet",
                        teacher: "professeur",
                        terms: "conditions",
                        test_description: "description test",
                        test_locale: "localisation test",
                        test_name: "nom test",
                        text: "texte",
                        time: "heure",
                        title: "titre",
                        updated_at: "mis \u00e0 jour \u00e0",
                        username: "nom d'utilisateur",
                        year: "ann\u00e9e",
                    },
                },
            },
            json: {
                "(and :count more error)": "(et :count erreur en plus)",
                "(and :count more errors)": "(et :count erreurs en plus)",
                "A new verification link has been sent to the email address you provided during registration.":
                    "Un nouveau lien de v\u00e9rification a \u00e9t\u00e9 envoy\u00e9 \u00e0 l'adresse e-mail que vous avez indiqu\u00e9e lors de votre inscription.",
                "A new verification link has been sent to your email address.":
                    "Un nouveau lien de v\u00e9rification a \u00e9t\u00e9 envoy\u00e9 \u00e0 votre adresse e-mail.",
                "All rights reserved.": "Tous droits r\u00e9serv\u00e9s.",
                "Already registered?": "D\u00e9j\u00e0 inscrit\u00b7e ?",
                "Are you sure you want to delete your account?":
                    "\u00cates-vous s\u00fbr\u00b7e de vouloir supprimer votre compte ?",
                Cancel: "Annuler",
                "Click here to re-send the verification email.":
                    "Cliquez ici pour renvoyer l'e-mail de v\u00e9rification.",
                Confirm: "Confirmer",
                "Confirm Password": "Confirmer le mot de passe",
                "Current Password": "Mot de passe actuel",
                Dashboard: "Tableau de bord",
                "Delete Account": "Supprimer le compte",
                Email: "E-mail",
                "Email Password Reset Link":
                    "Lien de r\u00e9initialisation du mot de passe",
                "Ensure your account is using a long, random password to stay secure.":
                    "Assurez-vous d'utiliser un mot de passe long et al\u00e9atoire pour s\u00e9curiser votre compte.",
                Forbidden: "Interdit",
                "Forgot your password?": "Mot de passe oubli\u00e9 ?",
                "Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.":
                    "Mot de passe oubli\u00e9 ? Pas de soucis. Veuillez nous indiquer votre adresse e-mail et nous vous enverrons un lien de r\u00e9initialisation du mot de passe.",
                "Go to page :page": "Aller \u00e0 la page :page",
                "Hello!": "Bonjour !",
                "If you did not create an account, no further action is required.":
                    "Si vous n'avez pas cr\u00e9\u00e9 de compte, vous pouvez ignorer ce message.",
                "If you did not request a password reset, no further action is required.":
                    "Si vous n'avez pas demand\u00e9 de r\u00e9initialisation de mot de passe, vous pouvez ignorer ce message.",
                'If you\'re having trouble clicking the ":actionText" button, copy and paste the URL below\ninto your web browser:':
                    'Si vous avez des difficult\u00e9s \u00e0 cliquer sur le bouton ":actionText", copiez et collez l\'URL ci-dessous\ndans votre navigateur Web :',
                "Log in": "Se connecter",
                "Log Out": "Se d\u00e9connecter",
                Login: "Connexion",
                Logout: "D\u00e9connexion",
                Name: "Nom",
                "New Password": "Nouveau mot de passe",
                "Not Found": "Non trouv\u00e9",
                of: "de",
                "Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.":
                    "Une fois que votre compte est supprim\u00e9, toutes vos donn\u00e9es sont supprim\u00e9es d\u00e9finitivement. Avant de supprimer votre compte, veuillez t\u00e9l\u00e9charger vos donn\u00e9es.",
                "Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.":
                    "Une fois que votre compte est supprim\u00e9, toutes les donn\u00e9es associ\u00e9es seront supprim\u00e9es d\u00e9finitivement. Pour confirmer que vous voulez supprimer d\u00e9finitivement votre compte, renseignez votre mot de passe.",
                "Page Expired": "Page expir\u00e9e",
                "Pagination Navigation": "Pagination",
                Password: "Mot de passe",
                "Payment Required": "Paiement requis",
                "Please click the button below to verify your email address.":
                    "Veuillez cliquer sur le bouton ci-dessous pour v\u00e9rifier votre adresse e-mail :",
                Profile: "Profil",
                "Profile Information": "Informations du profil",
                Regards: "Cordialement",
                Register: "Inscription",
                "Remember me": "Se souvenir de moi",
                "Resend Verification Email":
                    "Renvoyer l'e-mail de v\u00e9rification",
                "Reset Password": "R\u00e9initialisation du mot de passe",
                "Reset Password Notification":
                    "Notification de r\u00e9initialisation du mot de passe",
                results: "r\u00e9sultats",
                Save: "Sauvegarder",
                "Saved.": "Sauvegard\u00e9.",
                "Server Error": "Erreur serveur",
                "Service Unavailable": "Service indisponible",
                Showing: "Montrant",
                "Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.":
                    "Merci de vous \u00eatre inscrit(e) ! Avant de commencer, veuillez v\u00e9rifier votre adresse e-mail en cliquant sur le lien que nous venons de vous envoyer. Si vous n'avez pas re\u00e7u cet e-mail, nous vous en enverrons un nouveau avec plaisir.",
                "The given data was invalid.":
                    "La donn\u00e9e renseign\u00e9e est incorrecte.",
                "This is a secure area of the application. Please confirm your password before continuing.":
                    "Ceci est une zone s\u00e9curis\u00e9e de l'application. Veuillez confirmer votre mot de passe avant de continuer.",
                "This password reset link will expire in :count minutes.":
                    "Ce lien de r\u00e9initialisation du mot de passe expirera dans :count minutes.",
                to: "\u00e0",
                "Toggle navigation": "Afficher / masquer le menu de navigation",
                "Too Many Requests": "Trop de requ\u00eates",
                Unauthorized: "Non autoris\u00e9",
                "Update Password": "Mettre \u00e0 jour le mot de passe",
                "Update your account's profile information and email address.":
                    "Modifier le profil associ\u00e9 \u00e0 votre compte ainsi que votre adresse e-mail.",
                "Verify Email Address": "V\u00e9rifier l'adresse e-mail",
                "Whoops!": "Oups !",
                "You are receiving this email because we received a password reset request for your account.":
                    "Vous recevez cet e-mail car nous avons re\u00e7u une demande de r\u00e9initialisation de mot de passe pour votre compte.",
                "You're logged in!": "Vous \u00eates connect\u00e9\u00b7e !",
                "Your email address is unverified.":
                    "Votre adresse e-mail n'est pas v\u00e9rifi\u00e9e.",
            },
        },
    },
};

if (typeof window !== "undefined" && typeof window.Zora !== "undefined") {
    Object.assign(Zora.routes, window.Zora.routes);
}

export { Zora };
