 1042  mysql -u root sap -e "show tables"
 1043  mysql -u root sap -e "select * from ms_mem"
 1044  mysql -u root sap -e "select * from ms_mem where ms_name like 'sys%' and ms_name not like 'sysh%'"
 1045  mysql -u root sap -e "select sum(configurable_sys_mem) from ms_mem where ms_name like 'sys%' and ms_name not like 'sysh%'"
 1046  mysql -u root sap -e "select sum(configurable_sys_mem)/1024 from ms_mem where ms_name like 'sys%' and ms_name not like 'sysh%'"
 1047  mysql -u root sap -e "select sum(configurable_sys_mem)/1024 as total_mem, sum(curr_avail_sys_mem)/1024 as free_mem from ms_mem where ms_name like 'sys%' and ms_name not like 'sysh%'"
 1048  mysql -u root sap -e "select * from ms_mem where ms_name like 'sys%' and ms_name not like 'sysh%'"
 1049  mysql -u root sap -e "select * from ms_mem where ms_name like 'sysh%'"
 1050  mysql -u root sap -e "select * from ms_mem where ms_name like 'sysh%%%'"
 1051  mysql -u root sap -e "select * from ms_mem where ms_name like 'sysh___%'"
 1052  mysql -u root sap -e "select * from ms_mem where ms_name like 'sysh___-%'"
 1053  mysql -u root sap -e "select * from ms_mem where ms_name not like 'sysh___-%'"
 1054  mysql -u root sap -e "select * from ms_mem where ms_name not like 'sysh___-%' and ms_name not like 'sys__-%'"
 
 
id, svc, storage_name, capacity, free_capacity, used_capacity, dc_name

110.5----100%
87.77 ---- X
x = 87.77 * 100 / 110.5




select ms_mem.ms_name,truncate(sum(ms_mem.curr_avail_sys_mem)/1024,2) as free_mem, truncate((sum(ms_mem.configurable_sys_mem/1024) - sum(ms_mem.curr_avail_sys_mem/1024)),2) as used_mem, sum(ms_mem.configurable_sys_mem)/1024 as total_mem, truncate(((sum(ms_mem.configurable_sys_mem) - sum(ms_mem.curr_avail_sys_mem)) * 100) / sum(ms_mem.configurable_sys_mem),2) as mem_used_percentage, Abs(SUM(ms_cpu.configurable_sys_proc_units)) AS total_cpu, Abs(SUM(ms_cpu.curr_avail_sys_proc_units)) AS free_cpu, Abs(SUM(ms_cpu.configurable_sys_proc_units) - SUM(ms_cpu.curr_avail_sys_proc_units)) AS used_cpu, TRUNCATE(Abs(SUM(ms_cpu.configurable_sys_proc_units) - SUM(ms_cpu.curr_avail_sys_proc_units)) * 100 / Abs(SUM(ms_cpu.configurable_sys_proc_units)), 2) AS cpu_used_percentage from ms_mem inner join ms_cpu on ms_mem.ms_name=ms_cpu.ms_name where ms_mem.ms_name like 'sysh___-%' group by ms_mem.ms_name


SELECT ms_cpu.ms_name, Abs(SUM(ms_cpu.configurable_sys_proc_units)) AS total_cpu, Abs(SUM(ms_cpu.curr_avail_sys_proc_units)) AS free_cpu, Abs(SUM(ms_cpu.configurable_sys_proc_units) - SUM(ms_cpu.curr_avail_sys_proc_units)) AS used_cpu, TRUNCATE(Abs(SUM(ms_cpu.configurable_sys_proc_units) - SUM(ms_cpu.curr_avail_sys_proc_units)) * 100 / Abs(SUM(ms_cpu.configurable_sys_proc_units)), 2) AS used_percentage FROM ms_cpu WHERE  ms_cpu.ms_name LIKE 'sysh___-%' group by ms_name




SELECT ms_name, Abs(SUM(configurable_sys_proc_units)) AS total_cpu, Abs(SUM(curr_avail_sys_proc_units)) AS free_cpu, Abs(SUM(configurable_sys_proc_units) - SUM(curr_avail_sys_proc_units)) AS used_cpu, TRUNCATE(Abs(SUM(configurable_sys_proc_units) - SUM(curr_avail_sys_proc_units)) * 100 / Abs(SUM(configurable_sys_proc_units)), 2) AS used_percentage FROM   ms_cpu WHERE  ms_name LIKE 'sysh___-%' group by ms_name;

select ms_name,truncate(sum(curr_avail_sys_mem)/1024,2) as free_mem, truncate((sum(configurable_sys_mem/1024) - sum(curr_avail_sys_mem/1024)),2) as used_mem, sum(configurable_sys_mem)/1024 as total_mem, truncate(((sum(configurable_sys_mem) - sum(curr_avail_sys_mem)) * 100) / sum(configurable_sys_mem),2) as used_percentage from ms_mem where ms_name like 'sysh___-%' group by ms_name;



=======


SELECT ms_mem.ms_name,ms_mem.configurable_sys_mem,ms_mem.curr_avail_sys_mem,ms_cpu.configurable_sys_proc_units,ms_cpu.curr_avail_sys_proc_units from ms_mem INNER JOIN ms_cpu on ms_mem.ms_name=ms_cpu.ms_name



SELECT ms_mem.ms_name,(ms_mem.configurable_sys_mem)/1024 as total_mem,truncate((ms_mem.curr_avail_sys_mem)/1024,2) as free_mem,ms_cpu.configurable_sys_proc_units,ms_cpu.curr_avail_sys_proc_units from ms_mem INNER JOIN ms_cpu on ms_mem.ms_name=ms_cpu.ms_name where ms_mem.ms_name like 'sysh___-%' group by ms_mem.ms_name

(configurable_sys_mem)/1024




select ms_mem.ms_name,truncate(sum(ms_mem.curr_avail_sys_mem)/1024,2) as free_mem,truncate((sum(ms_mem.configurable_sys_mem/1024) - sum(ms_mem.curr_avail_sys_mem/1024)),2) as used_mem,sum(ms_mem.configurable_sys_mem)/1024 as total_mem, truncate(((sum(ms_mem.configurable_sys_mem) - sum(ms_mem.curr_avail_sys_mem)) * 100) / sum(ms_mem.configurable_sys_mem),2) as mem_used_percentage,abs(SUM(ms_cpu.configurable_sys_proc_units)) AS total_cpu,abs(SUM(ms_cpu.curr_avail_sys_proc_units)) AS free_cpu, abs(SUM(ms_cpu.configurable_sys_proc_units) - SUM(ms_cpu.curr_avail_sys_proc_units)) AS used_cpu, TRUNCATE(abs(SUM(ms_cpu.configurable_sys_proc_units) - SUM(ms_cpu.curr_avail_sys_proc_units)) * 100 / Abs(SUM(ms_cpu.configurable_sys_proc_units)), 2) AS cpu_used_percentagefrom ms_mem inner join ms_cpu on ms_mem.ms_name=ms_cpu.ms_name where ms_mem.ms_name like 'sysh___-%' group by ms_mem.ms_name 


select ms_mem.ms_name,truncate(sum(ms_mem.curr_avail_sys_mem)/1024,2) as free_mem, truncate((sum(ms_mem.configurable_sys_mem/1024) - sum(ms_mem.curr_avail_sys_mem/1024)),2) as used_mem, sum(ms_mem.configurable_sys_mem)/1024 as total_mem, truncate(((sum(ms_mem.configurable_sys_mem) - sum(ms_mem.curr_avail_sys_mem)) * 100) / sum(ms_mem.configurable_sys_mem),2) as mem_used_percentage, Abs(SUM(ms_cpu.configurable_sys_proc_units)) AS total_cpu, Abs(SUM(ms_cpu.curr_avail_sys_proc_units)) AS free_cpu, Abs(SUM(ms_cpu.configurable_sys_proc_units) - SUM(ms_cpu.curr_avail_sys_proc_units)) AS used_cpu, TRUNCATE(Abs(SUM(ms_cpu.configurable_sys_proc_units) - SUM(ms_cpu.curr_avail_sys_proc_units)) * 100 / Abs(SUM(ms_cpu.configurable_sys_proc_units)), 2) AS cpu_used_percentage from ms_mem inner join ms_cpu on ms_mem.ms_name=ms_cpu.ms_name where ms_mem.ms_name like 'sysh___-%' group by ms_mem.ms_name