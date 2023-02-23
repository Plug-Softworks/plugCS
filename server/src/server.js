const express = require("express");
const dotenv = require("dotenv");
const path = require("path");
const cors = require("cors");
const logger = require("morgan");
const mongoose = require("mongoose");
const AfricasTalking = require("africastalking");
const { AT_CREDENTIALS } = require("./config");
const defaultRoutes = require("./routes/index");

const app = express();
dotenv.config({path: path.resolve(__dirname, "../.env")});
const MONGO_URI = process.env.SERVER_ENV == "production" ? process.env.MONGO_URI_PROD : process.env.MONGO_URI_DEV
const PORT = process.env.PORT ?? 4767;
const AT = AfricasTalking(AT_CREDENTIALS);

app.use(cors());
app.use(logger("dev"));

console.log({
    AT_apiKey: process.env.AT_API_KEY,
    AT_username: process.env.AT_API_USERNAME,
    AT_virtualNumber: process.env.AT_HOST_PHONE,
})

mongoose.set('strictQuery', true);

mongoose.connect(MONGO_URI, {}).then(() => {
    console.log("DB connected!!");
}).catch((e) => {
    console.log("ERROR connecting to DB!!");
    console.log(e);
})

// AT.VOICE

app.use("/", defaultRoutes)

app.listen(PORT, () => {
    console.log(`CS server up at port ${PORT}`);
})