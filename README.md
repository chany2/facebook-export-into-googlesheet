Installation
-------------

Create service account and get info with Google console

 1. Visit to https://console.developers.google.com and login
 2. Click on Credential tab and create new service then select Service account key![](https://raw.githubusercontent.com/chany2/facebook-export-into-googlesheet/master/Readme/CLick%20on%20your%20service%20account.png)
 3. Select the info then click Create button and save *.p12 file into your pc (we will use this file to set up automatic to login with Google) - name it as “service_api.p12” ![](https://raw.githubusercontent.com/chany2/facebook-export-into-googlesheet/master/Readme/Create%20button%20and%20save%20*.p12%20file.png) 
 4. You need to move the service_api.p12 file into your folder
 5. Click on “Manage service account” ![](https://raw.githubusercontent.com/chany2/facebook-export-into-googlesheet/master/Readme/Manage%20service%20account.png) 
 6. On your service account which you added at step 2 and select Edit link ![](https://raw.githubusercontent.com/chany2/facebook-export-into-googlesheet/master/Readme/step%202%20and%20select%20Edit%20link.png) 
 7. Check the Enable Google Apps Domain-wide Delegation and Save ![](https://raw.githubusercontent.com/chany2/facebook-export-into-googlesheet/master/Readme/step%202%20and%20select%20Edit%20link.png) 
 8. On your service account which you added at step 2 and select Edit link ![](https://raw.githubusercontent.com/chany2/facebook-export-into-googlesheet/master/Readme/step%202%20and%20select%20Edit%20link.png) 
 9. Check the Enable Google Apps Domain-wide Delegation and Save ![](https://raw.githubusercontent.com/chany2/facebook-export-into-googlesheet/master/Readme/Google%20Apps%20Domain-wide%20Delegation%20and%20Save.jpg) 
 10. Click on your service account  ![](https://raw.githubusercontent.com/chany2/facebook-export-into-googlesheet/master/Readme/CLick%20on%20your%20service%20account.png) 
 11. Copy Client Id and Service email address   ![](https://raw.githubusercontent.com/chany2/facebook-export-into-googlesheet/master/Readme/Copy%20Client%20Id%20and%20Service%20email%20address%20.png) 
  
Create and get api info with Facebook
 1. Visit to https://developers.facebook.com/ then create a facebook app
 2. Copy App ID and App Secret and replace into Config.php

Google Sheet
 1. Invite Service Email Address to Google Sheet   ![](https://raw.githubusercontent.com/chany2/facebook-export-into-googlesheet/master/Readme/Copy%20Client%20Id%20and%20Service%20email%20address%20.png)
 2. Create these columns    ![](https://raw.githubusercontent.com/chany2/facebook-export-into-googlesheet/master/Readme/google%20sheet%20columns.png) 
 3. Add your Facebook Group ID    ![](https://raw.githubusercontent.com/chany2/facebook-export-into-googlesheet/master/Readme/homepage%20to%20export.png) 
 

References
-------------
PHP Packages was used in this project
 1. https://github.com/tinapc/php-google-spreadsheet-client ⇐ Google Sheet API
 2. https://github.com/google/google-api-php-client ⇐ Google PHP client
 3. https://github.com/facebook/facebook-php-sdk-v4/ ⇐ Facebook API