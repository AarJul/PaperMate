import React from "react";
import ReactDOMClient from "react-dom/client";
import { NewAccount } from "./screens/NewAccount";

const app = document.getElementById("app");
const root = ReactDOMClient.createRoot(app);
root.render(<NewAccount />);
