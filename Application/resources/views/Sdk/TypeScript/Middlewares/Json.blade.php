import {IMiddleware} from "@crazy-factory/cf-service-client";
    export default class Json implements IMiddleware<any, any>{
        process(options: any, next?: (nextOptions: any) => any): any {
        return next(options).json();
    }
}