import {IMiddleware} from "cyberhck-test";
    export default class Json implements IMiddleware<any, any>{
        process(options: any, next?: (nextOptions: any) => any): any {
        return next(options).json();
    }
}