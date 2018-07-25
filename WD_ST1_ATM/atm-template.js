const ATM = {
    is_auth: false, 
    current_user:false,
    current_type:false,
     
    // All cash of ATM
    cash: 2000,

    // All available users
    users: [
        {number: '0000', pin: '000', debet: 0, type: 'admin'},
        {number: '0025', pin: '123', debet: 675, type: 'user'}
    ],

    // Messages for user and admin
    message: {
        authOk: 'Authorization OK',
        userNotFound: 'User number or pin is incorrect',
        paramErr: 'Please, use string type for parameters. Example .auth("1111", "111")',
        queueErr: 'Authorization is not possible until the previous user is logout',
        unauthorized: 'You are not authorized',
        logOut: 'You are logout',
        accessErr: 'You do not access to this function',
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

    // All operations
    reports: [],

    // Authorization
    auth: function(number, pin) {
        if (this.is_auth) {
            return this.logging(this.message.reportQueueErr,
                                this.message.queueErr, false);
        }

        if (typeof number !== 'string' || typeof pin !== 'string') {
            return this.logging(this.message.reportParamErr,
                                this.message.paramErr, false);
        }

        this.current_user = this.users.find((user) => {return user.number === number && user.pin === pin});

        if (this.current_user) {
            this.is_auth = true;
            this.current_type = this.current_user.type;
            return this.logging(`${this.current_type} ${this.current_user.number} ${this.message.reportAuthOk}`,
                                this.message.authOk, true);
        }

        return this.logging(this.message.reportUserNotFound,
                            this.message.userNotFound, false);
    },

    // Check current debet
    check: function() {
        if (!this.is_auth) {
            return this.logging(this.message.reportUnauthorized,
                                this.message.unauthorized, false);
        }

        return this.logging(`${this.current_type} ${this.current_user.number} ${this.message.reportCheck}`,
                            `Current debet: ${this.current_user.debet}`, true);
    },

    // Get cash - available for user only
    getCash: function(amount) {
        if (this.current_type !== 'user') {
            return this.logging(`getCash ${this.message.reportAccessErr}`,
                                this.message.accessErr, false);
        }

        if (!Number.isInteger(amount) || amount < 0) {
            return this.logging(this.message.reportAmountErr,
                                this.message.amountErr, false);
        }

        if (amount > this.current_user.debet) {
            return this.logging(this.message.reportUserCashDeficit,
                                this.message.userCashDeficit, false);
        }

        if (amount > this.cash) {
            return this.logging(this.message.reportAtmCashDeficit,
                                this.message.atmCashDeficit, false);
        }

        this.current_user.debet -= amount;
        this.cash -= amount;

        return this.logging(`user ${this.current_user.number} get ${amount}`,
                            `You get ${amount}`, true);
    },

    // Load cash - available for user only
    loadCash: function(amount){
        return this.addCash('user', 'loadCash', amount);
    },

    // Load cash to ATM - available for admin only
    load_cash: function(addition) {
        return this.addCash('admin', 'load_cash', addition);
    },

    // Get report about cash actions - available for admin only
    getReport: function() {
        if (this.current_type !== 'admin') {
            return this.logging(`getReport ${this.message.reportAccessErr}`,
                                this.message.accessErr, false);
        }

        this.reports.forEach((item) => (console.info(`${item.date}: ${item.event}`)));
    },

    // Log out
    logout: function() {
        if (!this.is_auth) {
            return this.logging(this.message.reportUnauthorized,
                                this.message.unauthorized, false);
        }

        this.logging(`${this.current_type} ${this.current_user.number} is logout`,
                      this.message.logOut, true);

        this.is_auth = this.current_user = this.current_type = false;
    },

    // Load cash to ATM
    addCash: function(userType, funcName, amount) {
        if (this.current_type !== userType) {
            return this.logging(`${funcName} ${this.message.reportAccessErr}`,
                                this.message.accessErr, false);
        }

        if (!Number.isInteger(amount) || amount < 0) {
            return this.logging(this.message.reportAmountErr,
                                this.message.amountErr, false);
        }

        if (userType === 'user') {
            this.current_user.debet += amount;
        }

        this.cash += amount;

        return this.logging(`${userType} ${this.current_user.number} load ${amount}`,
                            `You load ${amount}`, true);
    },

    // Add report and console logging
    logging: function(reportMsg, userMsg, isCorrect) {
        this.reports.push({date: new Date().toLocaleString('en-GB'), event: reportMsg});

        if (isCorrect) {
            console.info(userMsg);
        } else {
            console.warn(userMsg);
        }
    }
};