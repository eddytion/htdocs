#!/bin/perl -w

use strict;

my $file = "svc_update.csv";
unlink($file) if -e $file;

my @a_svcs = ("192.168.0.8","192.168.1.40","192.168.1.130","192.168.1.140","192.168.1.150");
my @a_results;

foreach my $svc (@a_svcs)
{
  my @a_storage = `ssh $svc "lsmdiskgrp -delim , -nohdr -bytes"`;
  chomp(@a_storage);
  foreach my $line (@a_storage)
  {
    my @a_params = split(/\,/,$line);
    my $s_storage = $a_params[1];
    my $s_capacity = $a_params[5];
    my $s_free_capacity = $a_params[7];
    my $s_used_capacity = $a_params[9];
    
    if($svc eq "192.168.0.8")
    {
      push(@a_results,"DEFAULT,SMSSVC,$s_storage,$s_capacity,$s_free_capacity,$s_used_capacity,AIX");
    }
    elsif($svc eq "192.168.1.40")
    {
      push(@a_results,"DEFAULT,SVC_Cluster_I,$s_storage,$s_capacity,$s_free_capacity,$s_used_capacity,DC53");
    }
    elsif($svc eq "192.168.1.130")
    {
      push(@a_results,"DEFAULT,SVC_Cluster_II,$s_storage,$s_capacity,$s_free_capacity,$s_used_capacity,DC23");
    }
    elsif($svc eq "192.168.1.140")
    {
      push(@a_results,"DEFAULT,SVC_Cluster_III,$s_storage,$s_capacity,$s_free_capacity,$s_used_capacity,DC23");
    }
    elsif($svc eq "192.168.1.150")
    {
      push(@a_results,"DEFAULT,SVC_Cluster_IV,$s_storage,$s_capacity,$s_free_capacity,$s_used_capacity,DC23");
    }
  }
}

open(FILE, ">> $file");
foreach my $result (@a_results)
{
  print FILE "$result \n";
}
close(FILE);