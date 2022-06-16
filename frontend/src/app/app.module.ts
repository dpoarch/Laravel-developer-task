import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { SubscribeComponent } from './subscribe/subscribe.component';

import { NbActionsModule, NbAlertModule, NbIconModule, NbThemeModule, NbToastrModule } from '@nebular/theme';
import { NbSidebarModule, NbLayoutModule, NbButtonModule, NbInputModule, NbCardModule } from '@nebular/theme';
import { FormBuilder, FormsModule, ReactiveFormsModule } from '@angular/forms'; 
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { HttpClientModule } from '@angular/common/http';
import { RedirectComponent } from './redirect/redirect.component';
import { NbEvaIconsModule } from '@nebular/eva-icons';


@NgModule({
  declarations: [
    AppComponent,
    SubscribeComponent,
    RedirectComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    NbThemeModule.forRoot(),
    NbSidebarModule.forRoot(),
    NbLayoutModule,
    NbSidebarModule, // NbSidebarModule.forRoot(), //if this is your app.module
    NbButtonModule,
    NbInputModule,
    NbCardModule,
    FormsModule,
    FormsModule,    //added here too
    ReactiveFormsModule,
    NbAlertModule,
    NbActionsModule,
    BrowserAnimationsModule,
    NbEvaIconsModule,
    NbIconModule,
    HttpClientModule,
    NbToastrModule.forRoot(),
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
