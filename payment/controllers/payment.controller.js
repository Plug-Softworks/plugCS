const dotenv = require("dotenv");
const { generateToken, generatePassword, generateTimestamp } = require("../helpers");
const path = require("path");
const axios = require("axios");


dotenv.config({path: path.resolve(__dirname, "./.env")});

const payInit = async (req, res) => {   
    try {
        const { phone, amount } = req.body;

        console.log({
            phone,
            amount
        })

        if (!phone || !amount) {
            return res.status(402).json({
                success: false,
                message: "Please provide the phone number and amount"
            })
        }


        console.log(`${process.env.DARAJA_KEY}, ${process.env.DARAJA_KEY, process.env.DARAJA_SECRET}`)

        // request for token
        const token = await generateToken(process.env.DARAJA_KEY, process.env.DARAJA_SECRET);

        console.log(token);

        // process request
        const processPaymentParams = {
            "BusinessShortCode": 174379,
            "Password": generatePassword(174379, "pass1234~"),
            "Timestamp": generateTimestamp(),
            "TransactionType": "CustomerPayBillOnline",
            "Amount": amount,
            "PartyA": phone,
            "PartyB": 174379,
            "PhoneNumber": phone,
            "CallBackURL": `${process.env.BASE_URL}/confirm-payment`,
            "AccountReference": "Test",
            "TransactionDesc": "Test"
        }

        const stkPush = await axios.post("https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest", {...processPaymentParams}, {
            headers: {
                'Authorization': `Bearer ${token.access_token}`
            }
        });
        

        console.log(stkPush?.data)
        

        return res.status(200).json({
            success: false,
            message: "Payment service",
            data: {
                phone,
                amount
            }
        });
    } catch(e) {
        console.log(e);
        return res.status(400).json({
            success: false,
            message: "request failed"
        })
    }
    
}

module.exports = {
    payInit
}