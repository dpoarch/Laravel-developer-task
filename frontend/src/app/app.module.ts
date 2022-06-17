import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';

import { NbActionsModule, NbAlertModule, NbIconModule, NbListModule, NbThemeModule, NbToastrModule } from '@nebular/theme';
import { NbSidebarModule, NbLayoutModule, NbButtonModule, NbInputModule, NbCardModule } from '@nebular/theme';
import { FormBuilder, FormsModule, ReactiveFormsModule } from '@angular/forms'; 
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { HttpClientModule } from '@angular/common/http';
import { RedirectComponent } from './redirect/redirect.component';
import { NbEvaIconsModule } from '@nebular/eva-icons';
import { HomeComponent } from './home/home.component';
import { ArticleComponent } from './article/article.component';


@NgModule({
  declarations: [
    AppComponent,
    RedirectComponent,
    HomeComponent,
    ArticleComponent
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
    NbListModule,
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
