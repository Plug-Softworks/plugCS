const { VoiceHelper, genResponse } = require("../helpers/voice.helper");
const prompts = require("../helpers/prompts");
const path = require("path");
const dotenv = require("dotenv");

dotenv.config({path: path.resolve(__dirname, "../../.env")});

// Initialize voice helper
const vHelper = new VoiceHelper({
    AT_apiKey: process.env.AT_API_KEY,
    AT_username: process.env.AT_API_USERNAME,
    AT_virtualNumber: process.env.AT_HOST_PHONE,
});

const home = async (req, res, next) => {
    try {
        const body = req.body;

        console.log(body);

        const callPrompt = vHelper.survey({
            textPrompt: prompts.introduction,
            finishOnKey: "#",
            timeout: 5,
            callbackUrl: `${process.env.BASE_URL}/emergency`
        })

        return res.status(200).send(genResponse(callPrompt));
    } catch(e) {
        console.log(e);
        return res.status(400).send(null);
    }
}

const emergency = async (req, res, next) => {
    try {
        const returnedParams = req.body;

        console.log(returnedParams);

        

        return res.status(200).send(null);
    } catch(e) {
        console.log(e);
        return res.status(400).send(null);
    }
}

module.exports = {
    home,
    emergency
}