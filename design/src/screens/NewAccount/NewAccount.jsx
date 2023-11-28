import React from "react";
import { Group } from "../../components/Group";
import { Rectangle } from "../../components/Rectangle";
import { RectangleWrapper } from "../../components/RectangleWrapper";
import "./style.css";

export const NewAccount = () => {
  return (
    <div className="new-account">
      <div className="div-2">
        <Rectangle className="rectangle-1" />
        <Group className="group-4" />
        <div className="overlap-group">
          <div className="text-wrapper-2">広告</div>
        </div>
        <div className="text-wrapper-3">新規アカウント</div>
        <img className="line" alt="Line" src="https://c.animaapp.com/0CyIvLaQ/img/line-4.svg" />
        <div className="text-wrapper-4">Full Name</div>
        <RectangleWrapper className="rectangle-7" />
        <div className="rectangle-2" />
        <div className="rectangle-3" />
        <div className="rectangle-4" />
        <div className="rectangle-5" />
        <div className="text-wrapper-5">Username</div>
        <div className="text-wrapper-6">Email</div>
        <div className="rectangle-6" />
        <div className="text-wrapper-7">Phone Number</div>
        <div className="text-wrapper-8">Preffered Language</div>
        <div className="text-wrapper-9">Password</div>
        <div className="text-wrapper-10">Re-enter Password</div>
        <div className="overlap">
          <div className="text-wrapper-11">submit</div>
        </div>
        <div className="overlap-2">
          <div className="text-wrapper-12">English</div>
          <img className="polygon" alt="Polygon" src="https://c.animaapp.com/0CyIvLaQ/img/polygon-1.svg" />
        </div>
      </div>
    </div>
  );
};
