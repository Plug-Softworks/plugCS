const router = require("express").Router();
const { payInit } = require("../controllers/payment.controller");

router.post("/request-payment", payInit);

router.post("/confirm-payment", async () => {});

module.exports = router;