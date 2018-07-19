const ATM = {
    is_auth: false, 
    current_user:false,
    current_type:false,
     
    /* All cash of ATM */
    cash: 2000,

    /* All available users */
    users: [
        {number: '0000', pin: '000', debet: 0, type: 'admin'},
        {number: '0025', pin: '123', debet: 675, type: 'user'}
    ],

    /* Messages for user and admin */
    message: {
        authOk: 'Authorization OK',
        userNotFound: 'User number or pin is incorrect',
        paramErr: 'Please, use string type for parameters. Example .auth("1111", "111")',
        queueErr: 'Authorization is not possible until the previous user is logout',
        unauthorized: 'You are not authorized',
        logOut: 'You are logout',
        userAccessErr: 'This function available for authorized user only',
        adminAccessErr: 'This function available for admin only',
        amountErr: 'The amount must be a positive integer',
        atmCashDeficit: 'In ATM not enough cash',
        userCashDeficit: 'On your account not enough cash',
        reportQueueErr: 'authorization queue error',
        reportParamErr: 'authorization parameters incorrect',
        reportAuthOk: 'authorized successfully',
        reportUserNotFound: 'user not found',
        reportUnauthorized: 'unauthorized user attempt',
        reportAccessErr: 'access error',
        reportCheck: 'check current debet',
        reportAmountErr: 'enter an incorrect amount',
        reportAtmCashDeficit: 'atm cash deficit',
        reportUserCashDeficit: 'user cash deficit'
    },

    /* All operations */
    reports: [],

    /* Authorization */
    auth: function(number, pin) {
        if (this.is_auth) {
            this.addReport(this.message.reportQueueErr);
            console.warn(this.message.queueErr);
            return false;
        }

        if (typeof number !== 'string' || typeof pin !== 'string') {
            this.addReport(this.message.reportParamErr);
            console.warn(this.message.paramErr);
            return false;
        }

        const user = this.users.find((user) => {return user.number === number && user.pin === pin});

        if (user !== undefined) {
            this.is_auth = true;
            this.current_user = user;
            this.current_type = user.type;
            this.addReport(`${this.current_type} ${this.current_user.number} ${this.message.reportAuthOk}`);
            console.info(this.message.authOk);
            return true;
        }

        this.addReport(this.message.reportUserNotFound);
        console.warn(this.message.userNotFound);
        return false;
    },

    /* Check current debet */
    check: function() {
        if (!this.is_auth) {
            this.addReport(this.message.reportUnauthorized);
            console.warn(this.message.unauthorized);
            return false;
        }

        this.addReport(`${this.current_type} ${this.current_user.number} ${this.message.reportCheck}`);
        console.info(`Current debet: ${this.current_user.debet}`);
        return true;
    },

    /* Get cash - available for user only */
    getCash: function(amount) {
        if (this.current_type !== 'user') {
            this.addReport(this.message.reportAccessErr);
            console.warn(this.message.userAccessErr);
            return false;
        }

        if (!Number.isInteger(amount) || amount < 0) {
            this.addReport(this.message.reportAmountErr);
            console.warn(this.message.amountErr);
            return false;
        }

        if (amount > this.current_user.debet) {
            this.addReport(this.message.reportUserCashDeficit);
            console.warn(this.message.userCashDeficit);
            return false;
        }

        if (amount > this.cash) {
            this.addReport(this.message.reportAtmCashDeficit);
            console.warn(this.message.atmCashDeficit);
            return false;
        }

        this.current_user.debet -= amount;
        this.cash -= amount;

        this.addReport(`user ${this.current_user.number} get ${amount}`);
        console.info(`You get ${amount}`);
        return true;
    },

    /* Load cash - available for user only */
    loadCash: function(amount){
        if (this.current_type !== 'user') {
            this.addReport(this.message.reportAccessErr);
            console.warn(this.message.userAccessErr);
            return false;
        }

        if (!Number.isInteger(amount) || amount < 0) {
            this.addReport(this.message.reportAmountErr);
            console.warn(this.message.amountErr);
            return false;
        }

        this.current_user.debet += amount;
        this.cash += amount;

        this.addReport(`user ${this.current_user.number} load ${amount}`);
        console.info(`You load ${amount}`);
        return true;
    },

    /* Load cash to ATM - available for admin only */
    load_cash: function(addition) {
        if (this.current_type !== 'admin') {
            this.addReport(this.message.reportAccessErr);
            console.warn(this.message.adminAccessErr);
            return false;
        }

        if (!Number.isInteger(addition) || addition < 0) {
            this.addReport(this.message.reportAmountErr);
            console.warn(this.message.amountErr);
            return false;
        }

        this.cash += addition;
        this.addReport(`admin load ${addition}`);
        console.info(`ATM cash ${this.cash}`);
        return true;
    },

    /* Get report about cash actions - available for admin only */
    getReport: function() {
        if (this.current_type !== 'admin') {
            console.warn(this.message.adminAccessErr);
            return false;
        }

        this.reports.forEach((item) => (console.info(`${item.date}: ${item.event}`)));
        return true;
    },

    /* Log out */
    logout: function() {
        if (!this.is_auth) {
            this.addReport(this.message.reportUnauthorized);
            console.warn(this.message.unauthorized);
            return false;
        }

        this.addReport(`${this.current_type} ${this.current_user.number} is logout`);
        this.is_auth = this.current_user = this.current_type = false;

        console.info(this.message.logOut);
        return true;
    },

    /* Add report */
    addReport: function(message) {
        this.reports.push({date: new Date().toLocaleString('en-GB'), event: message});
    }
};