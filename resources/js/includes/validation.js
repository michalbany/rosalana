import {
    Form as VeeForm,
    Field as VeeField,
    defineRule,
    ErrorMessage,
    configure,
} from "vee-validate";
import {
    required,
    min,
    max,
    alpha_spaces as alphaSpaces,
    email,
    alpha_dash as alphaDash,
    min_value as minVal,
    max_value as maxVal,
    confirmed,
    not_one_of as excluded,
    numeric,
} from "@vee-validate/rules";

// Custom rules
// Datum není v minulosti
function minDate(value) {
    const today = new Date();
    today.setHours(0, 0, 0, 0); // Reset time to the start of the day
    const userDate = new Date(value);

    return userDate >= today;
}


// Datum a čas není v minulosti
function minTime(value, [relatedDate]) {
    const now = new Date();
    const today = new Date(now.getFullYear(), now.getMonth(), now.getDate());
    const userDate = new Date(relatedDate);
    const userTime = new Date(userDate.toDateString() + ' ' + value);

    // jestli je `userDate` dnešní datum
    if (userDate.setHours(0, 0, 0, 0) === today.getTime()) {
        // Jestliže ano, zjistime, zda je čas větší než aktuální čas
        return userTime >= now;
    }
    // Pokud `userDate` není dnešní datum, je v pořádku
    return true;
}

  

export default {
    install(app) {
        app.component("VeeForm", VeeForm);
        app.component("VeeField", VeeField);
        app.component("ErrorMessage", ErrorMessage);

        defineRule("numeric", numeric); // only numbers
        defineRule("required", required); //form required
        defineRule('alphaDash', alphaDash); // only letters, numbers, dashes and underscores
        defineRule('tos', required) //form required
        defineRule("min", min); // min lenght
        defineRule("max", max); // max lenght
        defineRule("alphaSpaces", alphaSpaces); // only letters and spaces
        defineRule("email", email); // valid email
        defineRule("minVal", minVal); // min num value
        defineRule("maxVal", maxVal); // max num value
        defineRule("passwordMismatch", confirmed); // two fields matches
        defineRule("excluded", excluded); // not allowed choice
        defineRule("countryExcluded", excluded); // not allowed choice
        defineRule("minDate", minDate); // date is not in the past
        defineRule("minTime", minTime); // time is not in the past

        configure({
            generateMessage: (ctx) => {
                const messages = {
                    required: `${ctx.field} is required.`,
                    min: `${ctx.field} is too short.`,
                    max: `${ctx.field} is too long.`,
                    alphaSpaces: `${ctx.field} can only contain letters and spaces.`,
                    alphaDash: `${ctx.field} can only contain characters a-Z, 0-9, -, _`,
                    email: `${ctx.field} must be a valid email address.`,
                    minVal: `${ctx.field} is too low.`,
                    maxVal: `${ctx.field} is too high.`,
                    excluded: `You cannot use this value for the field ${ctx.field}.`,
                    countryExcluded: `Due to restrictions, we do not accept users from this location.`,
                    passwordMismatch: `Passwords do not match.`,
                    tos: `You must accept the Terms of Service.`,
                    minDate: `The date must not be in the past.`,
                    minTime: `The time must not be in the past.`,
                };
                const message = messages[ctx.rule.name]
                    ? messages[ctx.rule.name]
                    : `The field ${ctx.field} is invalid.`;

                return message;
            },
            validateOnBlur: true,
            validateOnChange: false,
            validateOnInput: false,
            validateOnModelUpdate: false,
        });
    },
};