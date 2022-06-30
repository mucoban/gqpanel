const gulp = require("gulp");
const concat = require("gulp-concat");
const directoryPart = "public_html/";

gulp.task("default", async () => {
    gulp.watch("../" + directoryPart + "assets/scripts/dev/*.js", gulp.parallel(["concat"]));
    gulp.watch("../" + directoryPart + "assets/scripts/devpanel/*.js", gulp.parallel(["concat-panel"]));
});

/************* main.js ********************************/

gulp.task("concat", async () => {
    gulp.src("../" + directoryPart + "assets/scripts/dev/*.js")
        .pipe(concat("main.js"))
        .pipe(gulp.dest("../" + directoryPart + "assets/scripts"));
});

/************* main.js END ********************************/

/************* panelmain.js ********************************/

gulp.task("concat-panel", async () => {
    gulp.src("../" + directoryPart + "assets/scripts/devpanel/*.js")
        .pipe(concat("panelmain.js"))
        .pipe(gulp.dest("../" + directoryPart + "assets/scripts"));
});

/************* panelmain.js END ********************************/


