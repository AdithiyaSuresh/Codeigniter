import { environment } from "../../environments/environment";

export class serviceUrl 
{
    public host = environment.baseUrl;
    public reg = "codeigniter/signup";
    public log = "codeigniter/signin";
    public forgot = "codeigniter/foorgot";

}