/**
 * Assignment 1.
 * Calculate the sum of all numbers in a certain range
 * (from "start number" to "end number").
 */
function sumAll() {
    const values = getValueById("task1_in1", "task1_in2");

    if (!isInteger(values[0]) || !isInteger(values[1]))
        return errMessage("task1_out", "input value is not an integer");

    const min = Math.min(values[0], values[1]);
    const max = Math.max(values[0], values[1]);
    let result = 0;

    for (let i = min; i <= max; i++)
        result += i;

    clearValueById("task1_in1", "task1_in2");
    setTextById("task1_out", "Sum all numbers from " + min + " to " + max + " is " + result);
}

/**
 * Assignment 2.
 * Calculate the sum of all numbers
 * of the certain range in which last digit ends
 * in 2, 3 or 7.
 */
function sumAllOf() {
    const values = getValueById("task2_in1", "task2_in2");
    const pattern = /[237]/;

    if (!isInteger(values[0]) || !isInteger(values[1]))
        return errMessage("task2_out", "input value is not an integer");

    const min = Math.min(values[0], values[1]);
    const max = Math.max(values[0], values[1]);

    let result = 0;
    for (let i = min; i <= max; i++) {
        const lastDigit = i.toString().substr(-1);
        if (pattern.test(lastDigit))
            result += i;
    }

    clearValueById("task2_in1", "task2_in2");
    setTextById("task2_out", "Sum all numbers (with last digit is 2, 3 or 7) from " + min + " to " + max + " is " + result);
}

/**
 * Assignment 3.
 * Draw a half of pyramid,
 * the rows of which are formed from stars like "*".
 */
function drawPyramid() {
    const rowNum = getValueById("task3_in")[0];

    if (!isPositiveInteger(rowNum))
        return errMessage("task3_out", "input value is not a positive integer");

    let row = "";
    let pyramid = "";
    for (let i = 0; i < rowNum; i++) {
        row += "*";
        pyramid += row + "\n";
    }

    clearValueById("task3_in");
    setTextById("task3_out", pyramid);
}

/**
 * Assignment 4.
 * Convert seconds to time format hh:mm:ss.
 */
function formatTime() {
    const seconds = getValueById("task4_in")[0];

    if (!isPositiveInteger(seconds))
        return errMessage("task4_out", "input value is not a positive integer");

    const sph = 3600; // seconds per hour
    const spm = 60; // seconds per minute

    const h = Math.floor(seconds / sph).toString().padStart(2, "0");
    const m = Math.floor(seconds % sph / spm).toString().padStart(2, "0");
    const s = (seconds % sph % spm).toString().padStart(2, "0");

    clearValueById("task4_in");
    setTextById("task4_out", seconds + "s converted to " + h + ":" + m + ":" + s);
}

/**
 * Assignment 5.
 * To specified age add to string 'год', 'года' or 'лет'.
 */
function studentAge() {
    const years = getValueById("task5_in")[0];

    if (!isPositiveInteger(years))
        return errMessage("task5_out", "input value is not a positive integer");

    clearValueById("task5_in");
    setTextById("task5_out", "Студенту " + timeStr(years, "year"));
}

/**
 * Assignment 6.
 * Calculate a time interval between two dates
 * entered in the format 'October 13, 2014 11:13:00'.
 */
function timeInterval() {
    const dates = getValueById("task6_in1", "task6_in2");
    const firstDate = new Date(dates[0]);
    const lastDate = new Date(dates[1]);
    const pattern = /^[a-z]+\s\d+,?\s\d+\s[0-2]\d:[0-5]\d:[0-5]\d$/i;

    if (!pattern.test(dates[0]) || !pattern.test(dates[1])
        || firstDate.toString() === "Invalid Date" || lastDate.toString() === "Invalid Date")
        return errMessage("task6_out", "date format is incorrect");

    const initDate = new Date(0);
    const interval = new Date(Math.abs(lastDate - firstDate));
    const array = [interval.getFullYear() - initDate.getFullYear(),
                 interval.getMonth(),
                 interval.getDate() - initDate.getDate(),
                 interval.getHours() - initDate.getHours(),
                 interval.getMinutes(),
                 interval.getSeconds()];

    clearValueById("task6_in1", "task6_in2");
    setTextById("task6_out", "Между датами прошло " + timeStr(array[0], "year") + ", "
        + timeStr(array[1], "month") + ", " + timeStr(array[2], "day") + ", " + timeStr(array[3], "hour") + ", "
        + timeStr(array[4], "minute") + ", " + timeStr(array[5], "second"));
}

/**
 * Add to time a string value.
 * @param time Time as number
 * @param typeOfTime Type of time (year, month, day, hour etc)
 * @returns {string} Time with the corresponding string
 */
function timeStr(time, typeOfTime) {
    const pattern1 = /\d*[1]$/;
    const pattern2 = /\d*[234]$/;
    const pattern3 = /\d*(11|12|13|14)$/;
    let array;

    switch (typeOfTime) {
        case "year":
            array = ["год", "года", "лет"];
            break;
        case "month":
            array = ["месяц", "месяца", "месяцев"];
            break;
        case "day":
            array = ["день", "дня", "дней"];
            break;
        case "hour":
            array = ["час", "часа", "часов"];
            break;
        case "minute":
            array = ["минута", "минуты", "минут"];
            break;
        case "second":
            array = ["секунда", "секунды", "секунд"];
            break;
    }

    if (pattern1.test(time) && !pattern3.test(time)) {
        return time + " " + array[0];
    } else if (pattern2.test(time) && !pattern3.test(time)) {
        return time + " " + array[1];
    } else {
        return time + " " + array[2];
    }
}

/**
 * Assignment 7.
 * Find a zodiac sign by date
 * which entered in the format '2014-12-31'.
 */
function findZodiac() {
    const date = getValueById("task7_in")[0];
    const dateObj = new Date(date);
    const pattern = /^\d+-\d+-\d+$/;

    if (!pattern.test(date) || dateObj.toString() === "Invalid Date")
        return errMessage("task7_out", "date format is incorrect");

    const month = dateObj.getMonth();
    const day = dateObj.getDate();
    clearValueById("task7_in");

    switch (month) {
        case 0:
            return (day >= 20) ? setHTMLById("task7_out", "<p>Aquarius</p><img src='images/aquarius.png'>")
                               : setHTMLById("task7_out", "<p>Capricorn</p><img src='images/capricorn.png'>");
        case 1:
            return (day >= 19) ? setHTMLById("task7_out", "<p>Pisces</p><img src='images/pisces.png'>")
                               : setHTMLById("task7_out", "<p>Aquarius</p><img src='images/aquarius.png'>");
        case 2:
            return (day >= 21) ? setHTMLById("task7_out", "<p>Aries</p><img src='images/aries.png'>")
                               : setHTMLById("task7_out", "<p>Pisces</p><img src='images/pisces.png'>");
        case 3:
            return (day >= 20) ? setHTMLById("task7_out", "<p>Taurus</p><img src='images/taurus.png'>")
                               : setHTMLById("task7_out", "<p>Aries</p><img src='images/aries.png'>");
        case 4:
            return (day >= 21) ? setHTMLById("task7_out", "<p>Gemini</p><img src='images/gemini.png'>")
                               : setHTMLById("task7_out", "<p>Taurus</p><img src='images/taurus.png'>");
        case 5:
            return (day >= 21) ? setHTMLById("task7_out", "<p>Cancer</p><img src='images/cancer.png'>")
                               : setHTMLById("task7_out", "<p>Gemini</p><img src='images/gemini.png'>");
        case 6:
            return (day >= 23) ? setHTMLById("task7_out", "<p>Leo</p><img src='images/leo.png'>")
                               : setHTMLById("task7_out", "<p>Cancer</p><img src='images/cancer.png'>");
        case 7:
            return (day >= 23) ? setHTMLById("task7_out", "<p>Virgo</p><img src='images/virgo.png'>")
                               : setHTMLById("task7_out", "<p>Leo</p><img src='images/leo.png'>");
        case 8:
            return (day >= 23) ? setHTMLById("task7_out", "<p>Libra</p><img src='images/libra.png'>")
                               : setHTMLById("task7_out", "<p>Virgo</p><img src='images/virgo.png'>");
        case 9:
            return (day >= 23) ? setHTMLById("task7_out", "<p>Scorpio</p><img src='images/scorpio.png'>")
                               : setHTMLById("task7_out", "<p>Libra</p><img src='images/libra.png'>");
        case 10:
            return (day >= 22) ? setHTMLById("task7_out", "<p>Sagittarius</p><img src='images/sagittarius.png'>")
                               : setHTMLById("task7_out", "<p>Scorpio</p><img src='images/scorpio.png'>");
        case 11:
            return (day >= 22) ? setHTMLById("task7_out", "<p>Capricorn</p><img src='images/capricorn.png'>")
                               : setHTMLById("task7_out", "<p>Sagittarius</p><img src='images/sagittarius.png'>");
    }
}

/**
 * Assignment 8.
 * Draw a chessboard with size in the format '8x8'.
 */
function drawChessboard() {
    const size = getValueById("task8_in")[0];
    const pattern = /^\d+x\d+$/;

    if (!pattern.test(size))
        return errMessage("task8_out", "chessboard size is incorrect");

    clearTextById("task8_out");
    clearValueById("task8_in");

    const rowNum = size.substring(0, size.indexOf("x"));
    const colNum = size.substring(size.indexOf("x") + 1);

    for (let row = 0; row < rowNum; row++) {
        const chessRow = createChessRow();
        for (let col = 0; col < colNum; col++)
            chessRow.appendChild(createChessCell(row, col));
        document.getElementById("task8_out").appendChild(chessRow);
    }
}

/**
 * Create row of a chessboard.
 * @returns {HTMLDivElement} chessboard row.
 */
function createChessRow() {
    const chessRow = document.createElement("div");
    chessRow.style.display = "flex";
    chessRow.style.flexDirection = "row";

    return chessRow;
}

/**
 * Create cell of a chessboard.
 * @param row Index of row
 * @param col Index of column
 * @returns {HTMLDivElement} chessboard cell
 */
function createChessCell(row, col) {
    const cell = document.createElement("div");
    cell.style.width = "20px";
    cell.style.height = "20px";

    if (row % 2 === 0) {
        cell.style.backgroundColor = (col % 2 === 0) ? "black" : "white";
    } else {
        cell.style.backgroundColor = (col % 2 !== 0) ? "black" : "white";
    }

    return cell;
}

/**
 * Assignment 9.
 * Find a number of a porch and a floor
 * by a room number.
 */
function roomNumber() {
    const values = getValueById("task9_in1", "task9_in2", "task9_in3", "task9_in4");
    const porchNum = values[0];
    const floorNum = values[1];
    const roomOnFloor = values[2];
    const room = values[3];

    if (!isPositiveInteger(porchNum) || !isPositiveInteger(floorNum)
        || !isPositiveInteger(roomOnFloor) || !isPositiveInteger(room))
        return errMessage("task9_out", "input value is not a positive integer");

    let count = 0;
    for (let porch = 1; porch <= porchNum; porch++) {
        for (let floor = 1; floor <= floorNum; floor++) {
            for (let roomFl = 1; roomFl <= roomOnFloor; roomFl++) {
                count++;
                if (count == room)
                    setTextById("task9_out", "Room " + room + " located on porch " + porch + " and " + "floor " + floor);
            }
        }
    }

    clearValueById("task9_in1", "task9_in2", "task9_in3", "task9_in4");
}

/**
 * Assignment 10.
 * Calculate a sum of digits of input number.
 */
function sumDigit() {
    const number = getValueById("task10_in")[0];

    if (!isPositiveInteger(number))
        return errMessage("task10_out", "input value is not a positive integer");

    const arrDigit = number.split("");
    const result = arrDigit.reduce((sum, num) => sum + Number(num), 0);

    setTextById("task10_out", "Sum of digit for number " + number + " is " + result);
    clearValueById("task10_in");
}

/**
 * Assignment 11.
 * Remove from references 'https://' and 'http://'
 * and display corrected links in the sorted list.
 */
function sortLinks() {
    let line = getValueById("task11_in")[0];
    line = line.replace(/http:\/\//g, "");
    line = line.replace(/https:\/\//g, "");
    line = line.replace(/\s+/g, "");

    clearTextById("task11_out");
    clearValueById("task11_in");

    let arrayLinks = line.split(",");
    arrayLinks.sort();

    for (let i = 0; i < arrayLinks.length; i++) {
        const link = document.createElement("li");
        const anchor = document.createElement("a");
        anchor.setAttribute("href", "http://" + arrayLinks[i]);
        anchor.innerText = arrayLinks[i];
        link.appendChild(anchor);
        document.getElementById("task11_out").appendChild(link);
    }
}

/**
 * Display of error message.
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
 * Check for integer value.
 * @param value Input value
 * @returns {boolean} true - is integer, false - is not integer
 */
function isInteger(value) {
    const pattern = /^-?\d+$/;
    return pattern.test(value);
}

/**
 * Check for positive integer value.
 * @param value Input value
 * @returns {boolean} true - is positive integer, false - is not positive integer
 */
function isPositiveInteger(value) {
    const pattern = /^\d+$/;
    return pattern.test(value);
}

/**
 * Get value of element by ID.
 * @returns {Array} Array of values
 */
function getValueById() {
    const values = [];
    for (let i = 0; i < arguments.length; i++)
        values.push(document.getElementById(arguments[i]).value);

    return values;
}

/**
 * Clear element value by ID.
 */
function clearValueById() {
    for (let i = 0; i < arguments.length; i++)
        document.getElementById(arguments[i]).value = "";
}

/**
 * Set text for element by ID.
 * @param elementId Element identifier
 * @param text Text content
 */
function setTextById(elementId, text) {
    document.getElementById(elementId).innerText = text;
}

/**
 * Set html code for element by ID.
 * @param elementId Element identifier
 * @param htmlCode HTML code
 */
function setHTMLById(elementId, htmlCode) {
    document.getElementById(elementId).innerHTML = htmlCode;
}

/**
 * Remove text content for element by ID.
 */
function clearTextById() {
    for (let i = 0; i < arguments.length; i++)
        document.getElementById(arguments[i]).innerText = "";
}


