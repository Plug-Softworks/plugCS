const express = require("express");
const app = express();
const path = require("path");
const dotenv = require("dotenv");
const cors = require("cors");
const logger = require("morgan");
dotenv.config({path: path.resolve(__dirname, "./.env")});
const PORT = process.env.PAYMENT_SERVER_PORT;
const payRoutes = require("./routes/pay.route");

app.use(cors());

app.use(express.json());

app.use(logger("dev"));

app.get("/", (req, res, next) => {
    return res.status(200).send("CS_payment");
});

app.use("/pay", payRoutes);

app.listen(PORT, () => {
    console.log(`Server up on PORT ${PORT}`)
})