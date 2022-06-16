import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { ISubscribe } from '../subscribe/subscribe';

@Injectable({
  providedIn: 'root'
})
export class SubscribeService {
  private _url = " http://127.0.0.1:8000/api";
  constructor(private http: HttpClient) { }

  

  list(id:any): Observable<ISubscribe[]>{
    return this.http.get<ISubscribe[]>(this._url + '/checkstatus/'+id);
  }

  addSubscription(data:ISubscribe){
    return this.http.post(this._url+'/send_subscription', data);
  }

  confirmSubscription(data: ISubscribe){
    return this.http.post(this._url+'/confirm_subscription', data);
  }
}
