import { useState } from "react";
import MyLabel from "./MyLabel";

interface Valeurs {
    type : string ,
    name : string,
    id : string,
    labelValue: string,
    inputValue : any,
    onChangeValue: any
}

export default function MyInput(props: Valeurs) {

    return (
        <div className="my-4">
            <MyLabel labelFor={props.id}>{props.labelValue}</MyLabel>
            <input
                type={props.type}
                name={props.name}
                id={props.id}
                value={props.inputValue}
                onChange={props.onChangeValue}
            />
        </div>
    );
}
