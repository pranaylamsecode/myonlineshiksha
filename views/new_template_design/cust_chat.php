 <div class="wrap">
    <form action="options.php" method="post">
      <h2>Messenger Customer Chat Settings</h2>
      
      <div class="fbmcc-card card">
        <div class="intro">
          <div>
            <h2>Getting Started?</h2>
            <p class="fbmcc-instructions">Let people start a conversation on your
              website and continue in Messenger. It's easy to set up. We'll
              give you the code to add to your website.</p>
          </div>
          <div class="fbmcc-buttonContainer">
            <button
              class="fbmcc-setupButton"
              type="button"
              onclick="fbmcc_setupCustomerChat()"
            >
              
            </button>
          </div>
        </div>
      </div>
      <div
        id="fbmcc-page-params"
        class="fbmcc-card card"
        >
        <div>
          <p class="fbmcc-instructions">The code has already been added into your
            website. You can always go back through the setup process or edit
            the code manually below.
          </p>
        </div>
        <table class="fbmcc-settings">
          <tr valign="top">
            <th scope="row">Enabled</th>
            <td class="fbmcc-table-container">
              <div>
                <label class="fbmcc-switch">
                  <input
                    id="fbmcc-enabled"
                    value="1"
                    name="fbmcc_enabled"
                    type="checkbox"
                    
                  >
                  <span class="fbmcc-slider round"></span>
                </label>
              </div>
            </td>
          </tr>
          <tr valign="top">
            <th scope="row">Code Snippet</th>
          </tr>
        </table>
        <div class="fbmcc-codeContainer">
          <button id="fbmcc-editButton"
            class="fbmcc-editButton"
            type="button"
            onclick="fbmcc_editCode()"
          >
            Edit Code
          </button>
          <textarea
            id="fbmcc-codeArea"
            name="fbmcc_generatedCode"
            class="fbmcc-code-area"
            rows="17"
            cols="70"
            readonly="true"
          >
          </textarea>
        </div>
       <input type="submit" name="submit" value="test">
      </div>
    </form>
    <div class="fbmcc-card card">
      <div class="intro">
        <p class="fbmcc-instructions"> Having a problem with Messenger customer chat?
          Report the issue on the <a
            href='https://developers.facebook.com/support/bugs/'
            target='_blank'>
            Facebook Platform Bug Reports</a> page. If you get stuck or have questions,
            you can ask for help in the
            <a
            href='https://wordpress.org/support/plugin/facebook-messenger-customer-chat'
            target='_blank'>
            Messenger Customer Chat plugin forum</a>.
        </p>
      </div>
    </div>
  </div>