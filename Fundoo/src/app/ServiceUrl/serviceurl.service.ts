import { environment } from "../../environments/environment";

export class serviceUrl 
{
    public host = environment.baseUrl;
    public reg = "codeigniter/signup";
    public log = "codeigniter/signin";
    public forgot = "codeigniter/forgot";
    public getEmail ="codeigniter/getEmailId";
    public reset ="codeigniter/resetPassword";
    public note ="codeigniter/addNote";
    public disnote ="codeigniter/displayNote";
    public remainder = "codeigniter/addRemainder";
    public disRemainder = "codeigniter/displayRemainder";
    public delNote = "codeigniter/delNote";
    public deleteRemainder = "codeigniter/deleteRemainder";
    public changeColor = "codeigniter/changeColor";
    public editNote = "codeigniter/editNote";
    public changeDate = "codeigniter/changeDate";
    public archive = "codeigniter/archive";
    public fetchArch = "codeigniter/fetcharchive";
    public unarchived = "codeigniter/unarchive";
    public fetchTrash = "codeigniter/fetchTrash";
    public delete = "codeigniter/delete";
    public restore = "codeigniter/restore";
    public addLabels ="codeigniter/addLabels";
    public getLabel = "codeigniter/getLabel";
    public sociallogin = "codeigniter/socialLogin";
}