package com.example.laurynas.quisarwear;

import android.os.Bundle;
import android.os.Handler;
import android.support.wearable.activity.WearableActivity;
import android.view.View;
import android.widget.TextView;

public class MainActivity extends WearableActivity {
    Handler handler = new Handler();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        TextView timer = (TextView) findViewById(R.id.textView);
        for(int i = 60;i >= 0;i++){
            handler.postDelayed(new Runnable() {
                @Override
                public void run() {
                }
            }, 1000);
            timer.setText(String.valueOf(i));
        }
    }
    public void onNew(View view){
        TextView timer = (TextView) findViewById(R.id.textView);
        for(int i = 60;i >= 0;i++){
            handler.postDelayed(new Runnable() {
                @Override
                public void run() {
                }
            }, 1000);
            timer.setText(String.valueOf(i));
        }
        timer.setText("End");
    }
}
