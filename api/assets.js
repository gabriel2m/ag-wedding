import express from "express";
const app = express();

app.use('/assets', express.static(__dirname + '/public'));

export default app;