const axios = require("axios");
const moment = require("moment");
const crypto = require("crypto");

async function generateToken(key = "", secret = "") {
    const API_URL = `https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials`;

    if (key && secret) {
        const auth_header = new Buffer.from(`${key}:${secret}`).toString('base64');

        console.log(auth_header);

        const token = await axios.get(API_URL, {
            headers: {
                'Authorization': 'Basic ' + auth_header
            }
        })

        return token?.data ?? null;
    }

    return null;
};



function generatePassword(shortcode, passkey) {
    const timestamp = generateTimestamp();
    const pass = shortcode + passkey + timestamp;
    const hash = crypto.createHash('sha256').update(pass).digest('hex');
    return Buffer.from(`${shortcode}${hash}${timestamp}`).toString('base64');
}

function generateTimestamp() {
    return moment().format('YYYYMMDDHHmmss');
}

module.exports = {
    generateToken,
    generatePassword,
    generateTimestamp
}