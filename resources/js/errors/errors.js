export default class Errors {
    constructor() {
        this.errors = {}
    }

    record(errors) {
        this.errors = errors;
    }

    has(field) {
        return this.errors.hasOwnProperty(field);
    }

    get(field) {
        if (this.errors[field]) {
            return this.errors[field][0];
        }
    }

    set(field, message) {
        this.errors[field] = [message];
    }

    clear(field) {
        delete this.errors[field];
    }
    allClear() {
        this.errors = {}
    }
    allRecord() {
        return this.errors;
    }
}

