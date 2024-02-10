<style type="text/css">
section.liveCourses {
    padding: 80px 0px 40px 0px;
}
.liveCourseRating {
    font-size: 13px;
    color: #fff;
    text-align: center;
    margin: 0px 0px 6px 0px;
}
.liveCourseRating i {
    font-size: 12px;
    margin-right: 2px;
    position: relative;
}
.liveCourseImage img {
    height: 185px;
    width: 100%;
    object-fit: cover;
}
/*.liveCourseImage::after {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient( 
1turn
 ,hsla(0,0%,100%,0) 17%,rgba(68,67,67,.4) 57%,rgba(0,0,0,.7411764705882353));
    z-index: 2;
    cursor: pointer;
    border-radius: 8px;
    content: "";
}*/
  .liveCourseImage {
    position: relative;
}
.liveCourseAuthor {
    display: flex;
    align-items: center;
}
.liveCourseDetails .liveTitle:hover {
    color: #eee !important;
}
.liveCourseDetails .liveTitle {
    color: #fff!important;
    font-size: 16px;
    font-weight: 600;
    letter-spacing: 0.3px;
    line-height: 1.4em;
    margin: 0px;
    text-align: left;
    margin-bottom: 15px !Important;
    transition: 0.3s all ease;
    max-height: 45px;
    overflow: hidden;
    display: inline-block;
    min-height: 45px;
    border: 0px !important;
}
.liveCourseDetails {
    position: relative;
    background-color: #232c3b;
    padding: 20px 20px 20px 20px;
    box-shadow: 0 0 10px 0 rgb(0 0 0 / 10%);
    border-radius: 0px 0px 8px 8px;
}
.liveCourseAuthorImage img {
    width: 50px !important;
    border-radius: 50px !important;
    height: 50px;
    object-fit: cover;
    margin-right: 7px;
}
.liveCourses button {
    position: absolute;
    top: calc(50% - 40px);
    background: #fff !important;
    border-radius: 50px;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    padding: 0px !important;
    justify-content: center;
    box-shadow: 0 0 40px rgb(58 55 55 / 50%);
}
.liveCourses button:hover {
    background: #ea5252 !important;
    color: #fff !important;
}
.liveCourses button.owl-prev{
   left: -21px;
}
.liveCourses button.owl-next{
   right: -21px;
}
.liveCourseAuthorDetails h6 {
    color: #fff;
    margin: 0px;
}
.liveCourseAuthorDetails h5 {
    color: #fff;
    font-size: 13px;
    font-weight: 700;
    margin: 7px 0px 0px 0px;
}


.liveCourses button i {
    font-size: 26px;
    padding: 0px !important;
}
.liveCourseDetails a.regButton {
    width: auto;
    background: #fff;
    box-shadow: unset;
    border-radius: 8px;
    padding: 12px;
    color: #232c3b!important;
    display: block;
    font-weight: 600;
    font-size: 14px;
    margin: 23px 0px 0px -0px;
    border: 1px solid #fff !important;
    transition: 0.3s all ease;
    text-align: center;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}
.liveCourseDetails a.regButton:hover {
    background: #232c3b;
    color: #fff !important;
}
.liveCourseImage img {
    position: relative;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
}
.courseHeader h3 {
    margin: 0px;
    font-weight: 700;
    color: #2e3a59;
    line-height: 1.3em;
}
.courseHeader {
    padding: 0px 0px 20px 0px;
    display: flex;
    width: 100%;
    align-items: flex-end;
}
.courseHeader h3 {
    margin: 0px;
}
.courseHeader a {
    margin-left: auto;
}
.liveCourseTime {
    margin-left: auto;
}
.liveCourseTime h5 i {
    font-size: 12px;
    position: relative;
    top: -1px;
    left: -2px;
}
.liveCourseTime h5 {
    font-size: 13px;
    font-weight: 600;
    color: #fff;
    margin: 4px 0px 3px 0px !important;
}

.courseHeader a:hover {
    color: #ea5252;
}
.courseHeader a {
    color: #2e3a59;
    font-weight: 600;
    font-size: 14px;
    transition: 0.3s all ease;
}
.liveCourses .item {
    margin: 0 0 30px 0;
}
@media (max-width: 767px){
  .liveCourses button {
    top: calc(50% - 36px);
    width: 36px;
    height: 36px;
}
.liveCourses button i {
    font-size: 24px;
    padding: 0px !important;
}
.courseBody {
    padding: 0px 15px;
}
.courseBody {
    padding: 0px 15px;
    width: 350px;
    margin: 0 auto;
    max-width: 100%;
}
.liveCourseTime {
    margin-left: 0px;
    width: 100%;
}
.liveCourseTime h5 {
    margin: 21px 0px 0px 0px !important;
}
.liveCourseTime h5 i {
    font-size: 12px;
    position: relative;
    top: -1px;
    left: 0px;
    margin-right: 3px;
}
.liveCourses button.owl-prev {
    left: -16px;
}
.liveCourses button.owl-next {
    right: -16px;
}
.liveCourseAuthorDetails {
    width: calc(100% - 60px);
}
.liveCourseAuthor {
    display: flex;
    align-items: center;
    flex-direction: row;
    flex-wrap: wrap;
}
.liveCourseDetails h3 {
    max-height: unset;
    overflow: unset;
}
.liveCourses .item {
    width: 350px;
    margin: 0 auto 30px auto;
    max-width: 100%;
    padding: 0px !important;
}
section.liveCourses {
    padding: 40px 0px 10px 0px;
}
.liveCourseRating {
    margin: 19px 0px 0px 0px;
        text-align: left;
}

}
</style>
    <section class="liveCourses">
      <div class="container">
        <div class="innerSection">
            <div class="row">
                <div class="item col-md-4">
                  <div class="liveCourseImage">
                    <img src="https://myonlineshiksha.com/public/uploads/programs/img/thumb_232_216/3567_04-18-2019.png">
                  </div>
                  <div class="liveCourseDetails">
                    <div class="liveCourseTitle">
                      <a class="liveTitle" href="https://myonlineshiksha.com/online-courses/ch1-number-system-free-class-9th-mathematics-course-cbse-ncert-online-classescopy">Mathematics of Class 9th CBSE/NCERT Online Classes</a>
                    </div>
                    <div class="liveCourseAuthor">
                      <div class="liveCourseAuthorImage">
                        <img src="https://myonlineshiksha.com/public/uploads/users/img/3431_04-18-2019.png">
                      </div>
                      <div class="liveCourseAuthorDetails">
                        <h6>Taught by</h6>
                        <h5>Swati Mishra</h5>
                      </div>
                      <div class="liveCourseTime">
                        <div class="liveCourseRating">
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                          </div>
                          <h5><i class="fa fa-calendar-o" aria-hidden="true"></i> 4:00 PM, Mon 6 Sep</h5>
                        </div> 
                    </div>
                    <a href="https://myonlineshiksha.com/online-courses/ch1-number-system-free-class-9th-mathematics-course-cbse-ncert-online-classescopy" class="regButton">Register For Free</a>
                  </div>
                </div>
                <div class="item col-md-4">
                  <div class="liveCourseImage">
                    <img src="https://myonlineshiksha.com/public/uploads/programs/img/thumb_232_216/2751_09-28-2019.jpg">
                  </div>
                  <div class="liveCourseDetails">
                    <div class="liveCourseTitle">
                      <a class="liveTitle" href="https://myonlineshiksha.com/online-courses/class-10th-mathematics-cbse-ncert-online-classes">Mathematics of Class 10th CBSE/NCERT Online Classes</a>
                    </div>
                    <div class="liveCourseAuthor">
                      <div class="liveCourseAuthorImage">
                        <img src="https://myonlineshiksha.com/public/uploads/users/img/3431_04-18-2019.png">
                      </div>
                      <div class="liveCourseAuthorDetails">
                        <h6>Taught by</h6>
                        <h5>Swati Mishra</h5>
                      </div>
                      <div class="liveCourseTime">
                        <div class="liveCourseRating">
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                          </div>
                          <h5><i class="fa fa-calendar-o" aria-hidden="true"></i> 4:00 PM, Mon 6 Sep</h5>
                        </div> 
                    </div>
                    <a href="https://myonlineshiksha.com/online-courses/class-10th-mathematics-cbse-ncert-online-classes" class="regButton">Register For Free</a>
                  </div>
                </div>
                 <div class="item col-md-4">
                  <div class="liveCourseImage">
                    <img src="https://myonlineshiksha.com/public/uploads/programs/img/thumb_232_216/1389_08-13-2019.png">
                  </div>
                  <div class="liveCourseDetails">
                    <div class="liveCourseTitle">
                      <a class="liveTitle" href="https://myonlineshiksha.com/online-courses/basics-of-cloud-computing">Basics of Cloud Computing</a>
                    </div>
                    <div class="liveCourseAuthor">
                      <div class="liveCourseAuthorImage">
                        <img src="https://myonlineshiksha.com/public/uploads/users/img/2752_06-22-2019.png">
                      </div>
                      <div class="liveCourseAuthorDetails">
                        <h6>Taught by</h6>
                        <h5>Pranita Tiwari</h5>
                      </div>
                      <div class="liveCourseTime">
                        <div class="liveCourseRating">
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                          </div>
                          <h5><i class="fa fa-calendar-o" aria-hidden="true"></i> 4:00 PM, Mon 6 Sep</h5>
                        </div> 
                    </div>
                    <a href="https://myonlineshiksha.com/online-courses/basics-of-cloud-computing" class="regButton">Register For Free</a>
                  </div>
                </div>
                <div class="item col-md-4">
                  <div class="liveCourseImage">
                    <img src="https://myonlineshiksha.com/public/uploads/programs/img/thumb_232_216/2230_02-17-2021.jpg">
                  </div>
                  <div class="liveCourseDetails">
                    <div class="liveCourseTitle">
                      <a class="liveTitle" href="https://myonlineshiksha.com/online-courses/web-design-and-office-automation">Web Design and Office Automation</a>
                    </div>
                    <div class="liveCourseAuthor">
                      <div class="liveCourseAuthorImage">
                        <img src="https://myonlineshiksha.com/public/uploads/users/img/2752_06-22-2019.png">
                      </div>
                      <div class="liveCourseAuthorDetails">
                        <h6>Taught by</h6>
                        <h5>Pranita Tiwari</h5>
                      </div>
                      <div class="liveCourseTime">
                        <div class="liveCourseRating">
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                          </div>
                          <h5><i class="fa fa-calendar-o" aria-hidden="true"></i> 4:00 PM, Mon 6 Sep</h5>
                        </div> 
                    </div>
                    <a href="https://myonlineshiksha.com/online-courses/web-design-and-office-automation" class="regButton">Register For Free</a>
                  </div>
                </div>
            </div>
        </div>
      </div>
    </section>
