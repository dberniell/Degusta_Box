import { Injectable } from '@angular/core';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import {timeout} from 'rxjs/operators';

@Injectable({
  providedIn: 'root'
})
export class ApiService {
  private readonly headers: HttpHeaders;

  constructor(
    public http: HttpClient,
  ) {

    this.headers = new HttpHeaders({
      Accept: 'application/json',
    });
  }

  public getURL(endpoint: string): string {

    return 'http://localhost:8080/api' + endpoint;
  }

  get(endpoint: string, params?: any, options?): Promise<any> {
    if (!options) {
      options = { headers: this.headers };
    } else {
      if (!options.headers) {
        options.headers = this.headers;
      }
    }

    if (params) {
      options.params = params;
    }

    endpoint = this.getURL(endpoint);

    return new Promise((resolve, reject) => {
      this.http.get(endpoint, options)
        .pipe(timeout(30000))
        .subscribe(data => {
          resolve(data);
        }, err => {
          reject(this.handleErrors(err));
        });
    });
  }

  post(endpoint: string, body: any, options?) {
    if (!options) {
      options = { headers: this.headers.append('Content-Type', 'application/json') };
    }

    endpoint = this.getURL(endpoint);

    return new Promise((resolve, reject) => {
      this.http.post(endpoint, body, options)
        .pipe(timeout(30000))
        .subscribe(data => {
          resolve(data);
        }, err => {
          reject(err);
        });
    });
  }

  put(endpoint: string, body?: any, options?: object) {
    if (!options) {
      options = { headers: this.headers.append('Content-Type', 'application/json') };
    }

    endpoint = this.getURL(endpoint);

    return new Promise((resolve, reject) => {
      this.http.put(endpoint, body, options)
        .pipe(timeout(30000))
        .subscribe(data => {
          resolve(data);
        }, err => {
          reject(this.handleErrors(err));
        });
    });
  }

  delete(endpoint: string, body?: any, options?: object) {
    if (!options) {
      options = {
        headers: this.headers.append('Content-Type', 'application/json'),
        body: body
      };
    }

    return new Promise((resolve, reject) => {
      this.http.delete(this.getURL(endpoint), options)
        .pipe(timeout(30000))
        .subscribe(data => {
          resolve(data);
        }, err => {
          reject(this.handleErrors(err));
        });
    });
  }

  private handleErrors(error: any) {
    let errorMessage = '';
    console.log(error)
    if (error.error instanceof ErrorEvent) {
      // client-side error
      errorMessage = `Error: ${error.error.message}`;
    } else {
      // server-side error
      errorMessage = `Error : ${error.error && error.error.error ? (error.error.error.message ? error.error.error.message : error.error.error) : error.error.errors.detail}`;
    }
    return errorMessage;
  }
}
