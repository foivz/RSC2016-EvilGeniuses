package com.laurynas.laurynas.quisar;

import android.util.Log;

import com.google.firebase.iid.FirebaseInstanceId;
import com.google.firebase.iid.FirebaseInstanceIdService;

/**
 * Created by Laurynas on 2016-11-26.
 */
public class MyFirebaseInstaceIdService extends FirebaseInstanceIdService {
    private static final String REG_TOKEN = "REG_TOKEN";
    @Override
    public void onTokenRefresh() {
        String recent_token = FirebaseInstanceId.getInstance().getToken();
        System.out.print(recent_token);
        Log.d(REG_TOKEN, recent_token);
    }
}
