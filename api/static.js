import path from 'path';
import express from "express";

const app = express();

app.use('/static', express.static(path.resolve() + '/public'));

export default app;