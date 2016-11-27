package com.laurynas.laurynas.quisar;

import android.app.ProgressDialog;
import android.content.Context;
import android.graphics.Color;
import android.net.ConnectivityManager;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.KeyEvent;
import android.view.View;
import android.webkit.WebChromeClient;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.Button;
import android.widget.ProgressBar;
import android.widget.RelativeLayout;
import android.widget.TextView;
import android.widget.Toast;

import java.io.BufferedReader;
import java.io.FileNotFoundException;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;

public class MainActivity extends AppCompatActivity {
    WebView myWebView;
    String[] exUrls = new String[100];
    int level = 0;
    ProgressDialog dialog;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        exUrls[level] = "http://quisar.com/";
        if(!isNetworkAvailable(this)) {
            System.out.println("No connection");
            Toast.makeText(this, "Connection", Toast.LENGTH_SHORT).show();
            finish();
            System.exit(0);
        }
        myWebView = (WebView) findViewById(R.id.webview);
        WebSettings webSettings = myWebView.getSettings();
        webSettings.setJavaScriptEnabled(true);
        myWebView.getSettings().setSupportZoom(true);
        myWebView.getSettings().setBuiltInZoomControls(true);
        myWebView.setWebViewClient(new myWebViewClient());
        myWebView.setWebChromeClient(new myWebChromeClient());
        loadOnWebView(exUrls[level]);
    }
    @Override
    public boolean onKeyDown(int keyCode, KeyEvent event) {
        if (keyCode == KeyEvent.KEYCODE_BACK) {
            onBackButton();
            return false;
        }
        return super.onKeyDown(keyCode, event);
    }
    public static boolean isNetworkAvailable(Context context) {
        ConnectivityManager conMan = (ConnectivityManager) context.getSystemService(Context.CONNECTIVITY_SERVICE);
        if(conMan.getActiveNetworkInfo() != null && conMan.getActiveNetworkInfo().isConnected())
            return true;
        else
            return false;
    }
    public void onBackButton(){
        if (level > 0) {
            level--;
            loadOnWebView(exUrls[level]);
        }else{
            finish();
            System.exit(0);
        }
    }
    public void onBackButton(View view){
        if (level > 0) {
            level--;
            loadOnWebView(exUrls[level]);
        }else{
            finish();
            System.exit(0);
        }
    }

    public void loadOnWebView(String url){
        //makeToast("Loading " + url);
        myWebView.loadUrl(url);
        myWebView.setVisibility(View.GONE);
        Button button = (Button)findViewById(R.id.button);
        button.setVisibility(View.GONE);
        RelativeLayout rLayout = (RelativeLayout) findViewById (R.id.rLayout);
        rLayout.setBackgroundResource(R.drawable.splashscreen);
        findViewById(R.id.progressBar).setVisibility(View.VISIBLE);
        findViewById(R.id.textView).setVisibility(View.VISIBLE);
        ProgressBar progressBar = (ProgressBar)findViewById(R.id.progressBar);
        progressBar.setProgress(0);
        TextView textView = (TextView) findViewById(R.id.textView);
        textView.setText("Loaded " + String.valueOf(0)+"%");
    }
    public void makeToast(String str){
        Toast.makeText(this, str, Toast.LENGTH_SHORT).show();
    }

    private void writeToFile(String data,Context context) {
        try {
            OutputStreamWriter outputStreamWriter = new OutputStreamWriter(context.openFileOutput("config.txt", Context.MODE_PRIVATE));
            outputStreamWriter.write(data);
            outputStreamWriter.close();
        }
        catch (IOException e) {
            Log.e("Exception", "File write failed: " + e.toString());
        }
    }
    private String readFromFile(Context context) {

        String ret = "";

        try {
            InputStream inputStream = context.openFileInput("config.txt");

            if ( inputStream != null ) {
                InputStreamReader inputStreamReader = new InputStreamReader(inputStream);
                BufferedReader bufferedReader = new BufferedReader(inputStreamReader);
                String receiveString = "";
                StringBuilder stringBuilder = new StringBuilder();

                while ( (receiveString = bufferedReader.readLine()) != null ) {
                    stringBuilder.append(receiveString);
                }

                inputStream.close();
                ret = stringBuilder.toString();
            }
        }
        catch (FileNotFoundException e) {
            Log.e("login activity", "File not found: " + e.toString());
        } catch (IOException e) {
            Log.e("login activity", "Can not read file: " + e.toString());
        }

        return ret;
    }
    private class myWebViewClient extends WebViewClient {
        public boolean shouldOverrideUrlLoading(WebView view, String url)
        {
            level++;
            exUrls[level] = url;
            loadOnWebView(url);
            return true;
        }

        @Override
        public void onPageFinished(WebView view, String url) {
            findViewById(R.id.rLayout).setBackgroundColor(Color.parseColor("#61E9B1"));
            findViewById(R.id.webview).setVisibility(View.VISIBLE);
            findViewById(R.id.button).setVisibility(View.VISIBLE);
            findViewById(R.id.progressBar).setVisibility(View.GONE);
            findViewById(R.id.textView).setVisibility(View.GONE);
        }

    }
    private class myWebChromeClient extends WebChromeClient{
        public void onProgressChanged(WebView view, int progress)
        {
            ProgressBar progressBar = (ProgressBar)findViewById(R.id.progressBar);
            progressBar.setProgress(progress);
            TextView textView = (TextView) findViewById(R.id.textView);
            textView.setText("Loaded " + String.valueOf(progress)+"%");
        }
    }


}
