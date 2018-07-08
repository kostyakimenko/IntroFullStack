/* Max milliseconds for Date() */
const MAX_TIME_MS = 8640000000000000;
/* Milliseconds in a second */
const MS_IN_SEC = 1000;
/* Milliseconds in a hour */
const MS_IN_HOUR = 3600000;
/* Pattern for date as "October 13, 2014 11:13:00" */
const LONG_DATE_FORMAT = /^[a-z]+\s\d+,?\s\d+\s[0-2]\d:[0-5]\d:[0-5]\d$/i;
/* Pattern for date as "2014-12-31" */
const ISO_DATE_FORMAT = /^\d{4}-\d{2}-\d{2}$/;
/* Pattern for number */
const NUMBER = /^-?\d+(.\d+)?$/;
/* Error messages */
const ERR_MSG_INTEGER = "input value must be an integer";
const ERR_MSG_POSITIVE_INTEGER = "input value must be an integer and more then '0'";
const ERR_MSG_DATE = "input date is incorrect";
const ERR_MSG_NAN = "input value must be a number";
const ERR_MSG_BIG_NUMBER = "input number is too big";
const ERR_MSG_ROOM_NUMBER = "in the house there is no such room";

/**
 * Assignment 1.
 * Calculate the sum of all numbers in a certain range
 * (from "start number" to "end number").
 *
 * @param input1 First input element ID
 * @param input2 Second input element ID
 * @param output Output element ID
 */
function sumAll(input1, input2, output) {
    const startNumber = document.getElementById(input1).value;
    const endNumber = document.getElementById(input2).value;

    if (!isIntegers(startNumber, endNumber))
        return errMessage(output, ERR_MSG_INTEGER);

    const min = Math.min(startNumber, endNumber);
    const max = Math.max(startNumber, endNumber);

    let result = 0;
    for (let i = min; i <= max; i++)
        result += i;

    document.getElementById(output).innerText = "Sum all numbers from " + min + " to " + max + " is " + result;
    clearValue(input1, input2);
}

/**
 * Assignment 2.
 * Calculate the sum of all numbers
 * of the certain range in which last digit ends
 * in 2, 3 or 7.
 *
 * @param input1 First input element ID
 * @param input2 Second input element ID
 * @param output Output element ID
 */
function sumAllOf(input1, input2, output) {
    const startNumber = document.getElementById(input1).value;
    const endNumber = document.getElementById(input2).value;

    if (!isIntegers(startNumber, endNumber))
        return errMessage(output, ERR_MSG_INTEGER);

    const min = Math.min(startNumber, endNumber);
    const max = Math.max(startNumber, endNumber);

    let result = 0;
    for (let i = min; i <= max; i++) {
        const lastDigit = i % 10;
        if (lastDigit === 2 || lastDigit === 3 || lastDigit === 7)
            result += i;
    }

    document.getElementById(output).innerText = "Sum all numbers (with last digit is 2, 3 or 7) from "
                                                 + min + " to " + max + " is " + result;
    clearValue(input1, input2);
}

/**
 * Assignment 3.
 * Draw a half of pyramid,
 * the rows of which are formed from stars like "*".
 *
 * @param input Input element ID
 * @param output Output element ID
 */
function drawPyramid(input, output) {
    const rowNum = document.getElementById(input).value;

    if (!isPositiveIntegers(rowNum))
        return errMessage(output, ERR_MSG_POSITIVE_INTEGER);

    let row = "";
    let pyramid = "";
    for (let i = 0; i < rowNum; i++) {
        row += "*";
        pyramid += row + "\n";
    }

    document.getElementById(output).innerText = pyramid;
    clearValue(input);
}

/**
 * Assignment 4.
 * Convert seconds to time format hh:mm:ss.
 *
 * @param input Input element ID
 * @param output Output element ID
 */
function formatTime(input, output) {
    const inputSeconds = document.getElementById(input).value;
    const ms = inputSeconds * MS_IN_SEC;

    if (!isPositiveIntegers(inputSeconds))
        return errMessage(output, ERR_MSG_POSITIVE_INTEGER);

    if (ms > MAX_TIME_MS)
        return errMessage(output, ERR_MSG_BIG_NUMBER);

    const date = new Date(ms);
    const hours = Math.floor(ms / MS_IN_HOUR).toString().padStart(2, "0");
    const minutes = date.getMinutes().toString().padStart(2, "0");
    const seconds = date.getSeconds().toString().padStart(2, "0");

    document.getElementById(output).innerText = inputSeconds + "s " + "convert to "
                                                + hours + ":" + minutes + ":" + seconds;
    clearValue(input);
}

/**
 * Assignment 5.
 * To specified age add to string 'год', 'года' or 'лет'.
 *
 * @param input Input element ID
 * @param output Output element ID
 */
function studentAge(input, output) {
    const years = document.getElementById(input).value;

    if (!isPositiveIntegers(years))
        return errMessage(output, ERR_MSG_POSITIVE_INTEGER);

    document.getElementById(output).innerText = "Студенту " + timeStr(years, "year");
    clearValue(input);
}

/**
 * Assignment 6.
 * Calculate a time interval between two dates
 * entered in the format 'October 13, 2014 11:13:00'.
 *
 * @param input1 First input element ID
 * @param input2 Second input element ID
 * @param output Output element ID
 */
function timeInterval(input1, input2, output) {
    const inputDate1 = document.getElementById(input1).value;
    const inputDate2 = document.getElementById(input2).value;
    const date1 = new Date(inputDate1);
    const date2 = new Date(inputDate2);

    if (!LONG_DATE_FORMAT.test(inputDate1) || !LONG_DATE_FORMAT.test(inputDate2)
        || date1.getDate() != inputDate1.match(/\d+/) || date2.getDate() != inputDate2.match(/\d+/))
        return errMessage(output, ERR_MSG_DATE);

    /* Find of earlier and later date */
    const sortedTime = [date1.getTime(), date2.getTime()].sort();
    const firstDate = new Date(sortedTime[0]);
    const lastDate = new Date(sortedTime[1]);
    /* Find of amount of days in first month */
    const daysInMonth = new Date(firstDate.getFullYear(), firstDate.getMonth() + 1, 0).getDate();

    const arrTimeDiff = [lastDate.getFullYear() - firstDate.getFullYear(),
                       lastDate.getMonth() - firstDate.getMonth(),
                       lastDate.getDate() - firstDate.getDate(),
                       lastDate.getHours() - firstDate.getHours(),
                       lastDate.getMinutes() - firstDate.getMinutes(),
                       lastDate.getSeconds() - firstDate.getSeconds()];

    correctTime(arrTimeDiff, daysInMonth);

    document.getElementById(output).innerText = "Между датами прошло "
                                                 + timeStr(arrTimeDiff[0], "year") + ", "
                                                 + timeStr(arrTimeDiff[1], "month") + ", "
                                                 + timeStr(arrTimeDiff[2], "day") + ", "
                                                 + timeStr(arrTimeDiff[3], "hour") + ", "
                                                 + timeStr(arrTimeDiff[4], "minute") + ", "
                                                 + timeStr(arrTimeDiff[5], "second");
    clearValue(input1, input2);
}

/**
 * Correction of time values.
 * If the negative value it is subtracted from the maximum value for this category,
 * after then the next rank value is reduced by 1.
 *
 * @param arrTime Array with time values
 * @param daysInMonth Amount of days in the month
 */
function correctTime(arrTime, daysInMonth) {
    const maxTimeValue = {
        1: 12, // number of months
        2: daysInMonth, // number of days
        3: 24, // number of hours
        4: 60, // number of minutes
        5: 60 // number of seconds
    };

    for (let i = arrTime.length; i > 0; i--) {
        if (arrTime[i] < 0) {
            arrTime[i] += maxTimeValue[i];
            arrTime[i - 1]--;
        }
    }
}

/**
 * Add to time a string value.
 *
 * @param time Time as number
 * @param typeOfTime Type of time (year, month, day, hour etc)
 * @returns {string} Time with the corresponding string
 */
function timeStr(time, typeOfTime) {
    const pattern1 = [2, 3, 4];
    const pattern2 = [11, 12, 13, 14];
    const lastDigit = time % 10;
    const lastTwoDigits = time % 100;
    let postfix;

    switch (typeOfTime) {
        case "year":
            postfix = ["год", "года", "лет"];
            break;
        case "month":
            postfix = ["месяц", "месяца", "месяцев"];
            break;
        case "day":
            postfix = ["день", "дня", "дней"];
            break;
        case "hour":
            postfix = ["час", "часа", "часов"];
            break;
        case "minute":
            postfix = ["минута", "минуты", "минут"];
            break;
        case "second":
            postfix = ["секунда", "секунды", "секунд"];
            break;
    }

    if (lastDigit === 1 && lastTwoDigits !== 11) {
        return time + " " + postfix[0];
    } else if (pattern1.indexOf(lastDigit) !== -1 && pattern2.indexOf(lastTwoDigits) === -1) {
        return time + " " + postfix[1];
    } else {
        return time + " " + postfix[2];
    }
}

/**
 * Assignment 7.
 * Find a zodiac sign by date
 * which entered in the format '2014-12-31'.
 *
 * @param input Input element ID
 * @param output Output element ID
 */
function findZodiac(input, output) {
    const inputDate = document.getElementById(input).value;
    const date = new Date(inputDate);

    if (!ISO_DATE_FORMAT.test(inputDate) || date.getDate() != inputDate.substr(-2))
        return errMessage(output, ERR_MSG_DATE);

    const month = date.getMonth();
    const day = date.getDate();
    let html;

    switch (month) {
        case 0:
            html = (day >= 20) ? "<p>Aquarius</p><img src='images/aquarius.png'>" : "<p>Capricorn</p><img src='images/capricorn.png'>";
            break;
        case 1:
            html = (day >= 19) ? "<p>Pisces</p><img src='images/pisces.png'>" : "<p>Aquarius</p><img src='images/aquarius.png'>";
            break;
        case 2:
            html = (day >= 21) ? "<p>Aries</p><img src='images/aries.png'>" : "<p>Pisces</p><img src='images/pisces.png'>";
            break;
        case 3:
            html = (day >= 20) ? "<p>Taurus</p><img src='images/taurus.png'>" : "<p>Aries</p><img src='images/aries.png'>";
            break;
        case 4:
            html = (day >= 21) ? "<p>Gemini</p><img src='images/gemini.png'>" : "<p>Taurus</p><img src='images/taurus.png'>";
            break;
        case 5:
            html = (day >= 21) ? "<p>Cancer</p><img src='images/cancer.png'>" : "<p>Gemini</p><img src='images/gemini.png'>";
            break;
        case 6:
            html = (day >= 23) ? "<p>Leo</p><img src='images/leo.png'>" : "<p>Cancer</p><img src='images/cancer.png'>";
            break;
        case 7:
            html = (day >= 23) ? "<p>Virgo</p><img src='images/virgo.png'>" : "<p>Leo</p><img src='images/leo.png'>";
            break;
        case 8:
            html = (day >= 23) ? "<p>Libra</p><img src='images/libra.png'>" : "<p>Virgo</p><img src='images/virgo.png'>";
            break;
        case 9:
            html = (day >= 23) ? "<p>Scorpio</p><img src='images/scorpio.png'>" : "<p>Libra</p><img src='images/libra.png'>";
            break;
        case 10:
            html = (day >= 22) ? "<p>Sagittarius</p><img src='images/sagittarius.png'>" : "<p>Scorpio</p><img src='images/scorpio.png'>";
            break;
        case 11:
            html = (day >= 22) ? "<p>Capricorn</p><img src='images/capricorn.png'>" : "<p>Sagittarius</p><img src='images/sagittarius.png'>";
            break;
    }

    document.getElementById(output).innerHTML = html;
    clearValue(input);
}

/**
 * Assignment 8.
 * Draw a chessboard with size in the format '8x8'.
 *
 * @param input1 First input element ID
 * @param input2 Second input element ID
 * @param output Output element ID
 */
function drawChessboard(input1, input2, output) {
    const rows = document.getElementById(input1).value;
    const cols = document.getElementById(input2).value;

    if (!isPositiveIntegers(rows, cols))
        return errMessage(output, ERR_MSG_POSITIVE_INTEGER);

    document.getElementById(output).innerText = "";
    clearValue(input1, input2);

    for (let row = 0; row < rows; row++) {
        const chessRow = createChessRow();
        for (let col = 0; col < cols; col++)
            chessRow.appendChild(createChessCell(row, col));
        document.getElementById(output).appendChild(chessRow);
    }
}

/**
 * Create row of a chessboard.
 *
 * @returns {HTMLDivElement} chessboard row.
 */
function createChessRow() {
    const chessRow = document.createElement("div");
    chessRow.setAttribute("class", "chessboard__row");

    return chessRow;
}

/**
 * Create cell of a chessboard.
 *
 * @param row Index of row
 * @param col Index of column
 * @returns {HTMLDivElement} chessboard cell
 */
function createChessCell(row, col) {
    const cell = document.createElement("div");
    let className;

    if (row % 2 === 0) {
        className = (col % 2 === 0) ? "chessboard__col_black" : "chessboard__col_white";
    } else {
        className = (col % 2 !== 0) ? "chessboard__col_black" : "chessboard__col_white";
    }

    cell.setAttribute("class", className);

    return cell;
}

/**
 * Assignment 9.
 * Find a number of a porch and a floor
 * by a room number.
 *
 * @param input1 First input element ID
 * @param input2 Second input element ID
 * @param input3 Third input element ID
 * @param input4 Fourth input element ID
 * @param output Output element ID
 */
function roomNumber(input1, input2, input3, input4, output) {
    const porchNum = document.getElementById(input1).value;
    const floorNum = document.getElementById(input2).value;
    const roomOnFloor = document.getElementById(input3).value;
    const room = document.getElementById(input4).value;

    if (!isPositiveIntegers(porchNum, floorNum, roomOnFloor, room))
        return errMessage(output, ERR_MSG_POSITIVE_INTEGER);

    const maxFloor = Math.ceil(room / roomOnFloor);
    const porch = Math.ceil(maxFloor / floorNum);
    const floor = (maxFloor == floorNum) ? maxFloor : maxFloor % floorNum;

    if (porch > porchNum)
        return errMessage(output, ERR_MSG_ROOM_NUMBER);

    document.getElementById(output).innerText = "Room " + room + " located on porch " + porch + " and " + "floor " + floor;
    clearValue(input1, input2, input3, input4);
}

/**
 * Assignment 10.
 * Calculate a sum of digits of input number.
 *
 * @param input Input element ID
 * @param output Output element ID
 */
function sumDigit(input, output) {
    const number = document.getElementById(input).value;

    if (!NUMBER.test(number))
        return errMessage(output, ERR_MSG_NAN);

    const integer = number.replace(/\./g, "");
    const arrDigits = integer.split("");

    if (arrDigits[0] === "-") {
        arrDigits[1] = "-" + arrDigits[1];
        arrDigits.splice(0, 1);
    }

    const result = arrDigits.reduce((sum, num) => sum + Number(num), 0);

    document.getElementById(output).innerText = "Sum of digit for number " + number + " is " + result;
    clearValue(input);
}

/**
 * Assignment 11.
 * Remove from references 'https://' and 'http://'
 * and display corrected links in the sorted list.
 *
 * @param input Input element ID
 * @param output Output element ID
 */
function sortLinks(input, output) {
    const line = document.getElementById(input).value
        .replace(/http:\/\//g, "")
        .replace(/https:\/\//g, "")
        .replace(/\s+/g, "");

    document.getElementById(output).innerText = "";

    const links = line.split(",")
        .sort()
        .map((item) => "<li><a href=http://" + item + ">" + item + "</a></li>");

    document.getElementById(output).innerHTML = links.join("");
    clearValue(input);
}

/**
 * Display of error message.
 *
 * @param elementId Identifier of element
 * @param message Message text
 */
function errMessage(elementId, message) {
    const err = document.createElement("span");
    err.setAttribute("class", "error");
    err.innerText = "Error: " + message;
    document.getElementById(elementId).innerText = "";
    document.getElementById(elementId).appendChild(err);
}

/**
 * Check for integer values.
 *
 * @returns {boolean} true - values is integer, false - values isn't integer
 */
function isIntegers() {
    for (let i = 0; i < arguments.length; i++) {
        if (arguments[i] === "" || !Number.isInteger(Number(arguments[i])))
            return false;
    }

    return true;
}

/**
 * Check for positive integer values.
 *
 * @returns {boolean} true - values is positive integer, false - values isn't positive integer
 */
function isPositiveIntegers() {
    for (let i = 0; i < arguments.length; i++) {
        if (!Number.isInteger(Number(arguments[i])) || arguments[i] <= 0)
            return false;
    }

    return true;
}

/**
 * Clear element value by ID.
 */
function clearValue() {
    for (let i = 0; i < arguments.length; i++)
        document.getElementById(arguments[i]).value = "";
}




